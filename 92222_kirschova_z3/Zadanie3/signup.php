<?php
require "config.php";

$signupMsg = '';

//registracia
if (isset($_POST['submitSignup'])){
    $firstName = $_POST['firstNameSignup'];
    $lastName = $_POST['lastNameSignup'];
    $email = $_POST['emailSignup'];
    $login = $_POST['loginNameSignup'];
    $password = $_POST['passwordSignup'];

    $pwd_hash = password_hash($password,PASSWORD_DEFAULT);

    //ak sa v db nachadza pouzivatel s rovnakym loginom, nevytvori sa novy
    $duplicatesQuery = "SELECT id from users where login='{$login}' or email = '{$email}'" ;
    $duplicatesQueryStmt = $db->query($duplicatesQuery);
    $duplicatesResults = $duplicatesQueryStmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($duplicatesResults)>0) {
        $signupMsg = "Taký používateľ už existuje!";
    }
    else{
        //do db sa prida novy pouzivatel
        $query = "INSERT INTO users(firstname, lastname, email, login, password)
                VALUES ('{$firstName}', '{$lastName}', '{$email}', '{$login}', '{$pwd_hash}')";
        $db->exec($query);
        $signupMsg = "Registrácia prebehla úspešne.";
    }
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
        <title>Registrácia</title>
    </head>
    <body>
       <header>
            <h1>AUTENTIFIKÁCIA</h1>
        </header>
        <section id="form-section">
            <h2 class="heading-to-hide">section heading</h2>

            <!-- https://codepen.io/ehermanson/pen/KwKWEv -->

                <ul class="tab-group">
                    <li class="tab"><a href="index.php">PRIHLÁSENIE</a></li>
                    <li class="tab active"><a href="signup.php">REGISTRÁCIA</a></li>
                </ul>
                <div class="tab-content">
                    <div id="signup">
                        <h2>Registrácia</h2>

                        <form action="signup.php" method="post">

                            <div class="top-row">
                                <div class="field-wrap">
                                    <label for="firstNameSignup">Krstné meno<span class="req">*</span></label>
                                    <input id="firstNameSignup" name="firstNameSignup" type="text" required>
                                </div>

                                <div class="field-wrap">
                                    <label for="lastNameSignup">Priezvisko<span class="req">*</span></label>
                                    <input id="lastNameSignup" name="lastNameSignup" type="text" required>
                                </div>
                            </div>
                            <div class="field-wrap">
                                <label for = "emailSignup">Email<span class="req">*</span></label>
                                <input id="emailSignup" name="emailSignup" type="email" required>
                            </div>
                            <div class="field-wrap">
                                <label for = "loginNameSignup">Login<span class="req">*</span></label>
                                <input id="loginNameSignup" name="loginNameSignup" type="text" required>
                            </div>
                            <div class="field-wrap">
                                <label for="passwordSignup">Heslo<span class="req">*</span></label>
                                <input id="passwordSignup" name="passwordSignup" type="password" required>
                            </div>
                            <input type="submit" name="submitSignup" class="button button-block" value="Registrácia">
                            <div class="field-wrap msg">
                                <!-- vypis spravy o uspesnej/neuspesnej registracii -->
                                <?php
                                if (strlen($signupMsg)>0){
                                    echo $signupMsg;
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

