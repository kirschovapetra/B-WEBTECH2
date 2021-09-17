<?php
require "functions.php";
if(session_status() === PHP_SESSION_NONE) session_start();

//prihlasenie cez google
if (isset($_GET["code"])) {
    googleLogin();
}

$regularCount = 0;
$ldapCount = 0;
$googleCount = 0;

//statistiky prihlaseni
function fillStats(){
    global $db;

    $regular_query="SELECT firstname,lastname,login,email,logintype,logintimestamp FROM logins 
                    WHERE logintype='Registrácia'";
    $regular_results = ($db->query($regular_query))->fetchAll(PDO::FETCH_ASSOC);
    $regularCount = count($regular_results);

    $ldap_query="SELECT firstname,lastname,login,email,logintype,logintimestamp FROM logins 
                 WHERE logintype='LDAP'";
    $ldap_results = ($db->query($ldap_query))->fetchAll(PDO::FETCH_ASSOC);
    $ldapCount = count($ldap_results);

    $google_query="SELECT firstname,lastname,login,email,logintype,logintimestamp FROM logins 
                   WHERE logintype='Google'";
    $google_results = ($db->query($google_query))->fetchAll(PDO::FETCH_ASSOC);
    $googleCount = count($google_results);


    echo "Klasické prihlásenie: {$regularCount}<br>";
    echo "Prihlásenie cez LDAP: {$ldapCount} <br>";
    echo "Prihlásenie cez Google: {$googleCount} <br>";
}

//tabulka historie prihlaseni
function fillLoginTable(){
    global $db;

    if (isset($_SESSION['login'])) {

        //porovnava sa email aj login - pouzivatel sa moze prihlasit loginom aj mailom
        $query = "SELECT firstname,lastname,login,email,logintype,logintimestamp FROM logins 
                        WHERE login='{$_SESSION['login']}' OR email='{$_SESSION['login']}'";
        $results = ($db->query($query))->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $result) {
            echo "<tr class='table-item'>";
            echo "<td>{$result['logintype']}</td>";
            echo "<td>{$result['firstname']}</td>";
            echo "<td>{$result['lastname']}</td>";
            echo "<td>{$result['login']}</td>";
            echo "<td>{$result['email']}</td>";
            echo "<td>{$result['logintimestamp']}</td>";
            echo "</tr>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="script.js"></script>
    <title>Prihlasenie</title>
</head>
<body>
<header>
    <h1>PRIHLÁSENÝ POUŽÍVATEĽ: <?php

        if (isset($_SESSION['firstname']) && isset($_SESSION['lastname']))
            echo "{$_SESSION['firstname']} {$_SESSION['lastname']}";
        else {
            if (isset($_SESSION['login']))
                echo $_SESSION['login'];
        }
        ?>
    </h1>
    <nav>
        <ul>
            <li class="menu-item1">
                <a href="welcome.php" class="active">Domov</a>
            </li>
            <li class="menu-item2">
                <a href="logout.php">Odhlásiť sa</a>
            </li>
        </ul>
    </nav>
</header>
<section id="welcome-section">
    <h2>Vitajte!</h2>
    <button class="button button-block" onclick="showHistory(this)">Zobraziť minulé prihlásenia</button>
    <div id="history">
        <table id="table_id" class="display" style="width:100%;">
            <thead>
            <tr>
                <th>Typ</th>
                <th>Meno</th>
                <th>Priezvisko</th>
                <th>Login</th>
                <th>Email</th>
                <th>Čas</th>
            </tr>
            <tr id="filters">
                <th>Typ</th>
                <th>Meno</th>
                <th>Priezvisko</th>
                <th>Login</th>
                <th>Email</th>
                <th>Čas</th>
            </tr>
            </thead>
            <tbody>
            <?php
                fillLoginTable();
            ?>
            </tbody>
        </table>
    </div>

    <button class="button button-block" onclick="showStats(this)">Zobraziť štatistiky</button>
    <div id="stats">
        <?php
            fillStats();
        ?>
    </div>

</section>
<footer>
    Copyright &copy; 2020 Petra Kirschová<br>
    Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
</footer>

</body>
</html>

