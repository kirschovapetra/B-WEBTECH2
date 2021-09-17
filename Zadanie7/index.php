
<?php

include "config.php";
include "functions.php";

$msg = "";

function printWeather(){
    $weather = getWeather();

    $main = $weather["weather"][0]["main"];
    $description = $weather["weather"][0]["description"];
    $city = $weather["name"];
    $country = $weather["sys"]["country"];

    $time = $weather["dt"];
    $sunrise = $weather["sys"]["sunrise"];
    $sunset = $weather["sys"]["sunset"];

    $cloudiness = $weather["clouds"]["all"]." %";
    $wind = $weather["wind"]["speed"]." m/s";
    $pressure = $weather["main"]["pressure"]." hPa";
    $humidity = $weather["main"]["humidity"]." %";

    $temperature = $weather["main"]["temp"]." &deg;C";
    $feels_like = $weather["main"]["feels_like"]." &deg;C";
    $temp_min = $weather["main"]["temp_min"]." &deg;C";
    $temp_max = $weather["main"]["temp_max"]." &deg;C";

    echo "<h3>{$city} ({$country}) ".date('F j Y, H:m:s',$time)."</h3><br>";
    echo "{$main}, {$description}<br>";
    echo "AKTUÁLNA TEPLOTA: {$temperature}, pocitovo: {$feels_like}<br>";
    echo "MINIMÁLNA TEPLOTA: {$temp_min}, MAXIMÁLNA TEPLOTA: {$temp_max}<br>";
    echo "OBLAČNOSŤ: {$cloudiness}<br>";
    echo "RÝCHLOSŤ VETRA: {$wind}<br>";
    echo "ATMOSFERICKÝ TLAK: {$pressure}<br>";
    echo "VLHKOSŤ VZDUCHU: {$humidity}<br>";
    echo "VÝCHOD SLNKA: ".date('H:m:s',$sunrise)."<br>";
    echo "ZÁPAD SLNKA: ".date('H:m:s',$sunset)."<br>";
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>POČASIE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="script.js"></script>
</head>

<body onload="loadModal(<?=json_encode(empty(getUser()) && empty($_GET["accepted"]))?>,'#accessModal')">
<header>
    <h1>PREDPOVEĎ POČASIA</h1>
    <nav class="navbar navbar-expand-lg justify-content-center">
        <ul class="nav navbar-nav">
            <li class="active nav-item"><a href="index.php" class="nav-link">PREDPOVEĎ POČASIA</a></li>
            <li class="nav-item"><a href="location.php" class="nav-link">POLOHA</a></li>
            <li class="nav-item"><a href="visitors.php" class="nav-link">NÁVŠTEVY</a></li>
        </ul>
    </nav>
</header>

<?php
//okno na povolenie pristupu sa nezobrazuje ak uz povolil pristup
if (!empty($_GET["accepted"])){
    echo "<script>loadModal(false,'#accessModal')</script>";
    insertUser(); //pouzivatel sa vlozi do databazy
}
//zamietol - vypise sa $msg
if (!empty($_GET["denied"])) {
    $msg = "Pre zobrazenie informácií je treba povoliť prístup k polohe.";
}

//navsteva sa vlozi do databazy
insertVisit("PREDPOVEĎ POČASIA");

?>

<div class="container-fluid weather-output" id="output">
    <?php
        printWeather();
        showContent();
    ?>
</div>

<!-- okno na povolenie pristupu -->
<!-- https://www.w3schools.com/bootstrap/bootstrap_modal.asp -->
<div class="container">
    <div class="modal fade" id="accessModal" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-body">
                    <?php
                        echo empty($msg)? "Povolenie prístupu k polohe" : $msg;
                    ?>
                </div>
                <div class="modal-footer">
                    <form action="index.php" method="get">
                        <input type="submit" class="btn btn-success" id="accept-button" name="accepted" value="Povoliť"/>
                        <input type="submit" class="btn btn-danger" id="deny-button" name="denied" value="Zamietnuť"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    Copyright &copy; 2020 Petra Kirschová<br>
    Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
</footer>

</body>
</html>