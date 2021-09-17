<?php
require "functions.php";
$graph1_ill = array();
$graph1_countries = array();
getGraph1Data($graph1_countries,$graph1_ill);
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
                <a href="graph1.php" class="active">Graf 1</a>
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
    <div id="graph1" class="graph">
        <script>makeGraph(<?=json_encode($graph1_ill)?>,<?=json_encode($graph1_countries)?>,"graph1","Počet potvrdených prípadov na 100.000 obyvateľov");</script>
    </div>


</section>

<footer>
    Copyright &copy; 2020 Petra Kirschová<br>
    Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
</footer>
</body>
</html>


