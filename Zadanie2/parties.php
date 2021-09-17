<?php
    require "functions.php";
    $chairsCount = 0;
    $vladaCount = 0;
    $period = $_GET['period'];
    $submit = $_GET['submit'];
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
        <script src="script.js"></script>
        <title>Strany</title>
    </head>
    <body>
        <header>
            <h1>POLITICKÉ STRANY</h1>
            <nav>
                <ul>
                    <li class="menu-item1">
                        <a href="index.php">Ministerstvá</a>
                    </li>
                    <li>
                        <a href="parties.php">Strany</a>
                    </li>
                    <li class="menu-item2">
                        <a href="edit.php">Upraviť</a>
                    </li>
                </ul>
            </nav>
        </header>
        <section id="main-section">
            <h2 class="heading-to-hide">section heading</h2>
            <form action="parties.php" method="GET">
                <label for="period">Obdobie: </label>
                <select name="period" id="period">
                    <option>-</option>
                    <?php  fillPeriods($period); ?>
                </select>
                <input type="submit" name="submit" value="Zobraziť" />
            </form>

            <!--politicke strany v danom obdobi-->
            <h2>Politické strany vo volebnom období <?=$period?>: </h2>
            <table id="table_id" class="display">
                <thead>
                <tr>
                    <th>Názov strany</th>
                    <th>Skratka strany</th>
                    <th>Počet kresiel</th>
                </tr>
                <tr id="filters">
                    <th>Názov strany</th>
                    <th>Skratka strany</th>
                    <th>Počet kresiel</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if (isset($period)) {
                        fillPartiesTable();
                    }
                ?>
                </tbody>
            </table>
            <div>
                <table id="legend">
                    <tr>
                        <td class="greyLegend">Koalícia</td>
                        <td class="whiteLegend">Opozícia</td>
                    </tr>
                </table>
            </div>

            <!--vlady v danom obdobi-->
            <h2>Vlády vo volebnom období <?=$period?>: </h2>
            <table id="table_id2" class="display" style="margin-bottom:50px;">
                <thead>
                <tr>
                    <th>Obdobie</th>
                    <th>Od</th>
                    <th>Do</th>
                </tr>
                <tr id="filters2">
                    <th>Obdobie</th>
                    <th>Od</th>
                    <th>Do</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if (isset($period)) {
                        fillPeriodTable();
                    }
                ?>
                </tbody>
            </table>

            <!--vypis poctu kresiel pre koaliciu a poctu vlad v konkretnom obdobi-->
            <div id="chairs-div">
                <?php
                    if (isset($submit)) {
                        echo "<p>Počet kresiel pre koalíciu: {$chairsCount}</p>";
                        echo "<p>Počet vlád vo volebnom období {$period} : {$vladaCount}</p>";
                    }
                ?>
            </div>
        </section>
        <footer>
            Copyright &copy; 2020 Petra Kirschová<br>
            Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
        </footer>
    </body>
</html>