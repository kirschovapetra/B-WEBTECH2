<?php
include "config.php";
include "functions.php";

$ip = getIp();
insertVisit("POLOHA");

//vypise polohu podla ip
function printLocation(){
    global $ip;
    $location = getLocation($ip);

    if (!empty($location["success"]) && $location["success"]=="false"){
        echo "Nedá sa lokalizovať.";
        return;
    }

    echo "GPS: latitude = {$location["latitude"]}, longitude = {$location["longitude"]}<br>";
    echo "MESTO: {$location["city"]} <br>";
    echo "ŠTÁT: {$location["country_name"]} <br>";
    echo "HLAVNÉ MESTO: {$location["location"]["capital"]}<br>";

}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>POLOHA</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header>
    <h1>POLOHA</h1>
    <nav class="navbar navbar-expand-lg">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a href="index.php" class="nav-link">PREDPOVEĎ POČASIA</a></li>
            <li class="active nav-item"><a href="location.php" class="nav-link">POLOHA</a></li>
            <li class="nav-item"><a href="visitors.php" class="nav-link">NÁVŠTEVY</a></li>
        </ul>
    </nav>
</header>



<div class="container-fluid location-output" id="output">
    <h3>Ip adresa:</h3><?=$ip;?>
    <h3>Poloha:</h3>
    <?php
        printLocation();
        showContent();
    ?>
</div>

<footer>
    Copyright &copy; 2020 Petra Kirschová<br>
    Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
</footer>

</body>
</html>