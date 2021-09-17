<?php
    require "functions.php";

    $ministry = $_GET['selectAdd'];
    $addDate = $_GET['dateAdd'];
    $period = $_GET['selectPeriod'];
    $koalicia = $_GET['koalicia'];
    $status = '';

    if (isset($_GET['submitChange'])) {
        change($_GET['selectChange'],$status,$period);
    }
    if (isset($_GET['submitAdd'])) {
        add($_GET['nameAdd'],$status);
    }
    if (isset($_GET['submitDelete'])) {
        delete($_GET['nameDelete'],$status);
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
        <script src="script.js"></script>
        <title>Upraviť</title>
    </head>
    <body>
        <header>
            <h1>UPRAVIŤ DATABÁZU</h1>
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

            <form action="edit.php" method="GET">

                <!-- -------------------------zmenit koalíciu------------------------- -->

                <!--vyber obdobia-->
                <h3>Zmeniť koalíciu: </h3>
                <label for="selectPeriod">Obdobie: </label>
                <select name="selectPeriod" id="selectPeriod">
                    <option>-</option>
                    <?php
                    fillPeriods($period);
                    ?>
                </select>

                <input type="submit" name="submitPeriod" value="Vybrať"/>

                <!--vyber strany v danom obdobi-->
                <label for="selectChange">Strana: </label>
                <select name="selectChange" id="selectChange">
                    <option>-</option>
                    <?php
                    if (isset( $_GET['submitPeriod'])) {
                        //rozdelenie volebneho obdobia na pole, vezme sa iba zaciatocny rok
                        $parts = explode(" - ", $_GET['selectPeriod']);
                        fillParties($parts[0]);
                    }
                    ?>
                </select>

                <!--vyber ci je alebo nie je koalicia-->
                <label for="koalicia"> Koalícia: </label>
                <input type="checkbox" id="koalicia" name="koalicia" value="koalicia">

                <input type="submit" name="submitChange" value="Zmeniť koalíciu"/>

                <!-- -------------------------pridat ministra------------------------- -->
                <div class="form-div">
                    <h3>Pridať ministra: </h3>
                    <label for="nameAdd">Meno:</label>
                    <input type="text" name="nameAdd" id="nameAdd">

                <!--zadanie zaciatku posobenia-->
                    <label for="dateAdd"> Začiatok pôsobenia: </label>
                    <input type="Date" name="dateAdd" id="dateAdd">

                <!--vyber ministerstva-->
                    <label for="selectAdd">  Ministerstvo: </label>
                    <select name="selectAdd" id="selectAdd">
                        <option>-</option>
                        <?php
                        fillMinistries();
                        ?>
                    </select>

                    <input type="submit" name="submitAdd" value="Pridať"/>
                </div>

                <!-- -------------------------zmazat ministra------------------------- -->
                <div class="form-div">
                    <h3>Zmazať ministra: </h3>
                    <label for="nameDelete">Meno: </label>
                    <input type="text" name="nameDelete" id="nameDelete">

                    <input type="submit" name="submitDelete" value="Zmazať"/>
                </div>

                <!-- -------------------------ukoncit vladu------------------------- -->
                <div class="form-div">
                    <input type="submit" name="submitEnd" value="Ukončiť"/>
                </div>
            </form>

            <!--tabulky s vladami a ministrami v poslednom obdobi-->
            <div id="tables">
                <?php
                if (isset($_GET['submitEnd'])) {
                    endPeriod($status);
                }
                ?>
            </div>

            <!--vypis stavu upravy databazy-->
            <div id="status">
                <?=$status?>
            </div>

        </section>
        <footer>
            Copyright &copy; 2020 Petra Kirschová<br>
            Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
        </footer>
    </body>
</html>

