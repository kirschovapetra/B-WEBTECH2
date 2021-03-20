<?php
//PHPGangsta
require_once 'vendor/autoload.php';

if (isset($_GET['submitCodeInput'])){
    $codeInput = $_GET['codeInput'];
    $secretInput = trim($_GET['secretInput']);

    if ($ga->verifyCode($secretInput, $codeInput, 2)) {
        header("Location:welcome.php");
    } else {
        echo 'Autentifikácia neúspešná.';
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
        <title>2FA</title>
    </head>
    <body>
    <header>
        <h1>AUTENTIFIKÁCIA</h1>
    </header>
    <section id="form-section">
        <h2 class="heading-to-hide">section heading</h2>

        <div class="tab-content">
            <div id="auth">
                <h2>Overenie používateľa</h2>
                <form action="2FA.php" method="GET">
                    <div class="field-wrap">
                        <h3>Naskenujte QR kód: </h3>
                        <?php
                        /* podla kodu z prednasky + https://github.com/PHPGangsta/GoogleAuthenticator */

                            $ga = new PHPGangsta_GoogleAuthenticator();
                            $secret = $ga->createSecret();
                            $qrCodeUrl = $ga->getQRCodeGoogleUrl('Zad3', $secret);
                            echo "<img src='{$qrCodeUrl}' alt='QR code'>";
                        ?>
                    </div>
                    <div class="field-wrap">
                        <label for="codeInput">Google Authenticator code:<br></label>
                        <input id="codeInput" name="codeInput" type="text">
                        <input id="secretInput" name="secretInput" type="text" value="<?=$secret?>">
                    </div>
                    <input type="submit" name="submitCodeInput" class="button button-block" value="Overenie">
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