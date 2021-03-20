<?php
include "config.php";
include "functions.php";

insertVisit("NÁVŠTEVY");

$selected = "";
if (!empty($_GET["selected"])){
    $selected = $_GET["selected"];
}

//vypise tabulku navstevnikov aj so statmi
function printVisits() {
    global $db;

    $query = "SELECT COUNT(DISTINCT ip) as 'visitors',date,state,code FROM visits inner JOIN users ON user_id = users.id GROUP BY date,state,code";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $result) {
        $flag = getFlag($result["code"]);

        echo "<tr class='table-item'>";
        echo "<td class='clickable' id='{$result["code"]}'><a href='http://147.175.121.210:8056/zad7/visitors.php?selected={$result['state']}'><img src='{$flag}' width='25px'></a></td>";
        echo "<td>{$result['state']}</td>";
        echo "<td>{$result['visitors']}</td>";
        echo "</tr>";
    }

}

//vypise tabulku navstevnikov v konkretnom state
function printVisitsByState($state) {
    global $db;

    $query = "SELECT COUNT(DISTINCT ip) as 'visitors',date,city,lat,lon,state,code FROM visits 
                INNER JOIN users ON user_id = users.id AND state = '{$state}'
                GROUP BY date,city,lat,lon,state,code";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $result) {
        echo "<tr class='table-item'>";
        echo "<td>{$result['city']}</td>";
        echo "<td>{$result['visitors']}</td>";
        echo "</tr>";
    }

}

//vypise tabulku navstevnikov podla casu
function printVisitsByTime() {
    global $db;

    $query = "SELECT SUM(c1) as 'count1',SUM(c2) as 'count2',SUM(c3) as 'count3',SUM(c4) as 'count4' FROM ( 
        SELECT 
        SUM(time BETWEEN '06:00:01' AND '15:00:00') AS 'c1', 
        SUM(time BETWEEN '15:00:01' AND '21:00:00') AS 'c2', 
        SUM(time BETWEEN '21:00:01' AND '00:00:00') AS 'c3', 
        SUM(time BETWEEN '00:00:01' AND '06:00:00') AS 'c4', 
        user_id,page_name FROM visits 
        WHERE page_name = 'PREDPOVEĎ POČASIA' 
        GROUP BY user_id,page_name 
    ) as T";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $result) {
        echo "<tr class='table-item'>";
        echo "<td>{$result['count1']}</td>";
        echo "<td>{$result['count2']}</td>";
        echo "<td>{$result['count3']}</td>";
        echo "<td>{$result['count4']}</td>";
        echo "</tr>";
    }

}

//najnavstevovanejsia stranka
function printMaxVisits(){

    global $db;
    $query = "SELECT COUNT(*) as 'maxCount',page_name FROM visits GROUP BY page_name ORDER BY maxCount DESC";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);


    echo "{$results[0]['page_name']} ({$results[0]['maxCount']})";
}

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>NÁVŠTEVY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--maps-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!--custom-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="script.js"></script>
</head>
<body>
<header>
    <h1>NÁVŠTEVY</h1>
    <nav class="navbar navbar-expand-lg">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a href="index.php" class="nav-link">PREDPOVEĎ POČASIA</a></li>
            <li class="nav-item"><a href="location.php" class="nav-link">POLOHA</a></li>
            <li class="active nav-item"><a href="visitors.php" class="nav-link">NÁVŠTEVY</a></li>
        </ul>
    </nav>
</header>

<div id="output">
<div class="container-fluid table-output">
    <br><h3 class="text-center"><b>Najnavštevovanejšia stránka: </b>
        <?php
        printMaxVisits();
        ?>
    </h3>
<hr><br>

    <h3 class="text-center"><b>Počet návštevníkov v štátoch:</b></h3>
    <table class="table table-hover table-striped">
        <thead>
            <th></th>
            <th>Štát</th>
            <th>Počet návštevníkov</th>
        </thead>
        <tbody>
        <?php
        printVisits();
        ?>
        </tbody>
    </table>
<hr><br>

    <h3 class="text-center"><b>Počet návštevníkov v časoch:</b></h3>
    <table class="table table-hover table-striped">
        <thead>
            <th>6:00-15:00</th>
            <th>15:00-21:00</th>
            <th>21:00-24:00</th>
            <th>24:00-6:00</th>
        </thead>
        <tbody>
        <?php
        printVisitsByTime();
        ?>
        </tbody>
    </table>
<hr><br>

    <div id="mapid"></div>
</div>


<!-- modal okno s tabulkou miest v state -->
<!-- https://www.w3schools.com/bootstrap/bootstrap_modal.asp -->
<div class="container">
    <div class="modal fade" id="visitorsModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="text-center"><b><?=$selected?></b></h3>

                </div>
                <div class="modal-body">
                <table class="table table-hover table-striped modal-table">
                        <thead>
                        <th>Mesto</th>
                        <th>Počet návštevníkov</th>
                        </thead>
                        <tbody>
                        <?php
                            printVisitsByState($selected);
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</div>


    <?php
    if (!empty($selected)){
        echo "<script>loadModal(true,'#visitorsModal')</script>";
    }

    showContent();
    ?>


    <script>createMap(<?=getCities()?>);</script>

</div>
<footer>
    Copyright &copy; 2020 Petra Kirschová<br>
    Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
</footer>

</body>
</html>