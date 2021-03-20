<?php
require "config.php";

$loginMsg = '';

//pridanie zaznamu do tabulky "logins"
function insertLogin($firstname,$lastname,$login,$email,$type){
    global $db;
    date_default_timezone_set('Europe/Bratislava');
    $now = date("Y-m-d H:i:s");

    $logins_query = "INSERT INTO logins(firstname,lastname,login,email,logintype,logintimestamp) 
                VALUES('{$firstname}','{$lastname}','{$login}','{$email}', '{$type}','{$now}')";

    $db->exec($logins_query);
}

//klasicke prihlasenie
function login(){
    global $db,$loginMsg;
    if(session_status() === PHP_SESSION_NONE) session_start();
    $login = $_POST['loginNameLogin'];
    $password = $_POST['passwordLogin'];

    //v tabulke "users" sa najde zaznam s loginom alebo emailom, ktory zadal pouzivatel do formularu
    $users_query = "SELECT firstname,lastname,login,email,password FROM users 
                    WHERE login='{$login}' OR email='{$login}'";
    $users_row = ($db->query($users_query))->fetch(PDO::FETCH_ASSOC);

    //pouzivatel existuje
    if ($users_row && password_verify($password,$users_row['password'])) {
        //prida sa do tabulky "logins"
        insertLogin($users_row['firstname'],$users_row['lastname'],$login,$users_row['email'],"Registrácia");

        $_SESSION['login'] = $login;
        header("Location:2FA.php");
    }
    //neexistuje
    else{
        $loginMsg= "Nesprávny login alebo heslo.";
    }

}

// podla kodu z prednasky
function LDAPLogin(){
    global $loginMsg;
    if(session_status() === PHP_SESSION_NONE) session_start();
    $login = $_POST['loginNameLogin'];
    $password = $_POST['passwordLogin'];

    $dn  = 'ou=People, DC=stuba, DC=sk';
    $ldaprdn  = "uid=$login, $dn";

    $ldapconn = ldap_connect("ldap.stuba.sk")
     or die("Could not connect to LDAP server.");
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $password);
    if ($ldapconn && $ldapbind) {
        $results=ldap_search($ldapconn,$dn,"uid={$login}",array("givenname","surname","mail","uid"));
        $info=ldap_get_entries($ldapconn,$results);

        if (count($info)>0) {
            $firstName = $info[0]['givenname'][0];
            $lastName = $info[0]['sn'][0];
            $uid = $info[0]['uid'][0];
            $mail = $info[0]['mail'][0];

            insertLogin($firstName,$lastName,$uid,$mail,"LDAP");
            $_SESSION['login'] = $uid;
            header("Location:welcome.php");
        }
        else{
            $loginMsg = "Nesprávny login alebo heslo.";
        }
    }
    else{
        $loginMsg = "Nesprávny login alebo heslo.";
    }
    ldap_unbind($ldapconn);
}

//podla https://www.webslesson.info/2019/09/how-to-make-login-with-google-account-using-php.html
function googleLogin(){
    global $google_client;
    if(session_status() === PHP_SESSION_NONE) session_start();

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if(!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();

        if(!empty($data['given_name'])) {
            $_SESSION['firstname'] = $data['given_name'];
        }
        if(!empty($data['family_name'])) {
            $_SESSION['lastname'] = $data['family_name'];
        }
        if(!empty($data['email'])) {
            $_SESSION['login'] = $data['email'];
        }

        //pri google prihlaseni sa pouzivatel prihlasuje cez mail, preto bude v tabulke login = email
        insertLogin($_SESSION['firstname'],$_SESSION['lastname'],$_SESSION['login'],$_SESSION['login'],"Google");
    }
}