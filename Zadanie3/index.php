<?php
require "functions.php";

//klasicke prihlasenie
if (isset($_POST['submitRegularLogin'])){
    login();
}
//prihlasenie cez LDAP
if (isset($_POST['submitLDAPLogin'])){
    LDAPLogin();
}
?>

<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Prihlasenie</title>
    </head>
    <body>
    <header>
        <h1>AUTENTIFIKÁCIA</h1>
    </header>
    <section id="form-section">
        <h2 class="heading-to-hide">section heading</h2>

        <!-- podla https://codepen.io/ehermanson/pen/KwKWEv -->

                <ul class="tab-group">
                    <li class="tab active"><a href="index.php">PRIHLÁSENIE</a></li>
                    <li class="tab"><a href="signup.php">REGISTRÁCIA</a></li>
                </ul>
                <div class="tab-content">
                    <div id="login">
                        <h2>Prihlásenie</h2>
                        <form action="index.php" method="post">
                            <div class="field-wrap">
                                <label for="loginNameLogin">Login<span class="req">*</span></label>
                                <input id="loginNameLogin" name="loginNameLogin" type="text">
                            </div>
                            <div class="field-wrap">
                                <label for="passwordLogin">Heslo<span class="req">*</span></label>
                                <input id="passwordLogin" name="passwordLogin" type="password">
                            </div>
                            <input type="submit" name="submitRegularLogin" class="button button-block email" value="Prihlásenie">
                            <input type="submit" name="submitLDAPLogin" class="button button-block stu" value="Prihlásenie cez LDAP STU">
                            <div class="button button-block google">
                                <?php
                                    $url =$google_client->createAuthUrl();
                                    echo "<a href='$url'>Prihlásenie cez Google</a>";
                                ?>
                            </div>

                            <!-- vypis spravy o neuspesnom prihlaseni -->
                            <div class="field-wrap msg">
                                <?php
                                if (strlen($loginMsg)>0){
                                    echo $loginMsg;
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
    </section>
        <footer>
            Copyright &copy; 2020 Petra Kirschová<br>
            Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
        </footer>

    </body>
</html>

