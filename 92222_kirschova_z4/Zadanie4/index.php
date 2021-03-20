<?php
require "functions.php";

$countryCount = 0;
$stateCount = 0;
$dataCount = 0;
$msg = "";
getDBInfo($countryCount,$stateCount,$dataCount);
if ($_GET["delete"]) {
    clearDB();
    getDBInfo($countryCount,$stateCount,$dataCount);
    $msg = "Databáza je vymazaná.";
}
if ($_GET["download"]) {
    $msg = "Údaje sa sťahujú do databázy ...";
    init($msg);
    getDBInfo($countryCount,$stateCount,$dataCount);
}


?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="script.js"></script>
    <title>COVID</title>
</head>
<body>
<header>
    <h1>Štatistiky COVID-19</h1>
    <nav>
        <ul>
            <li class="menu-item1">
                <a href="index.php" class="active">Domov</a>
            </li>
            <li class="menu-item2">
                <a href="graph1.php">Graf 1</a>
            </li>
            <li class="menu-item2">
                <a href="graph2.php">Graf 2</a>
            </li>
            <li class="menu-item2">
                <a href="graph3.php">Graf 3</a>
            </li>
            <li class="menu-item2">
                <a href="graph4.php">Graf 4</a>
            </li>
        </ul>
    </nav>
</header>
<section id="main-section">
    <h2 class="heading-to-hide">section heading</h2>
    <form action="index.php" method="get">
        <input type="submit" name="download" value="Načítať dáta" class="menu-item1">
        <input type="submit" name="delete" value="Vymazať databázu" class="menu-item2">
    </form>
    <div>
        <?=$msg?>
    </div>
    <div>
        <br><h3>V databáze sa nachádza:</h3><br>
        <ul>
            <li><?=$countryCount?> krajín (tab. 'place')</li>
            <li><?=$stateCount?> štátov (tab. 'place')</li>
            <li><?=$dataCount?> záznamov (tab. 'data')</li>
        </ul>

        <br><h3>Zdroje:</h3><br>
        <a href="https://www.worldometers.info/world-population/population-by-country/">https://www.worldometers.info/world-population/population-by-country/</a><br>
        <a href="https://github.com/CSSEGISandData/COVID-19/tree/master/csse_covid_19_data/csse_covid_19_daily_reports">https://github.com/CSSEGISandData/COVID-19/tree/master/csse_covid_19_data/csse_covid_19_daily_reports</a>
    </div>
</section>

<footer>
    Copyright &copy; 2020 Petra Kirschová<br>
    Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
</footer>
</body>
</html>


