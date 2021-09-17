<?php
require "functions.php";
$illCount = 0;
$healthyCount = 0;
$deadCount = 0;

$graph4_dates = array();
$graph4_dead = array();
$graph4_healthy = array();
$graph4_ill=array();


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
                <a href="index.php">Domov</a>
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
                <a href="graph4.php" class="active">Graf 4</a>
            </li>
        </ul>
    </nav>
</header>
<section id="main-section">
    <h2 class="heading-to-hide">section heading</h2>
    <div id="graph4-container" class="graph-container">
        <form action="graph4.php" method="get">
            <select id="Country" name="Country">
                <?php
                fillCountrySelect();
                ?>
            </select>
            <input type="submit" name="CountrySubmit" value="Zobraziť graf">
        </form>
        <div id="graph4" class="graph">
            <?php
            if (isset($_GET["CountrySubmit"])) {
                $selectedCountry = $_GET["Country"];
                getGraph4Data($graph4_dates,$graph4_ill,$graph4_healthy,$graph4_dead,$selectedCountry);
                $graph4_dates_json = json_encode($graph4_dates);
                $graph4_dead_json = json_encode($graph4_dead);
                $graph4_healthy_json = json_encode($graph4_healthy);
                $graph4_ill_json = json_encode($graph4_ill);
                echo "<script>";
                echo "makeGraph4({$graph4_dates_json},{$graph4_ill_json},{$graph4_healthy_json},{$graph4_dead_json},
                    'graph4','Počet nových prípadov, vyliečených prípadov a úmrtí pre krajinu');";
                echo "</script>";
            }
            ?>
        </div>
        <div id="stats">
            <?php
            if (isset($_GET["CountrySubmit"])) {
                $selectedCountry = $_GET["Country"];
                getStats($illCount,$healthyCount,$deadCount,$selectedCountry);
                echo " <h3>Kumulatívny počet všetkých výskytov, vyliečení a úmrtí v krajine</h3>
                   <ul>
                       <li>Všetci nakazení: {$illCount}</li>
                       <li>Všetci vyliečení: {$healthyCount}</li>
                       <li>Všetky úmrtia: {$deadCount}</li>
                   </ul>";
            }
            ?>
        </div>
    </div>


</section>

<footer>
    Copyright &copy; 2020 Petra Kirschová<br>
    Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
</footer>
</body>
</html>


