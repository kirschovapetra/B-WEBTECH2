<?php
function fillTable($path) {
    $files = scandir($path);

    foreach ($files as $f) {
        echo "<tr class='table-item'>";
        $fileNameFull = $path . "/" . $f;

        //priecinky maju vypisany iba nazov, obsahuju link
        if (is_dir($fileNameFull)) {
            $link = "'index.php?path=" . $fileNameFull . "'";
            echo "<td class='folder'><a href={$link}>{$f}</a></td>";
            echo "<td></td>";
            echo "<td></td>";
        }
        //obycajne subory maju vypisany nazov, velkost a datum vytvorenia
        else {
            echo "<td>{$f}</td>";
            echo "<td>" . filesize($fileNameFull) . "</td>";
            echo "<td>" . date("F d Y H:i:s", filemtime($fileNameFull) + 3600) . "</td>";
        }
        echo "</tr>";
    }

}
?>

<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src="script.js"></script>
        <title>Tabulka</title>
    </head>
    <body>
        <header>
            <h1>ZADANIE 1 - TABUĽKA</h1>
            <nav>
                <ul>
                    <li class="menu-item1">
                        <a href="index.php">Zobraziť súbory</a>
                    </li>
                    <li class="menu-item2">
                        <a href="upload.php">Nahrať súbor</a>
                    </li>
                </ul>
            </nav>
        </header>
        <section id="main-section">
            <h2 class="heading-to-hide">section heading</h2>

            <table id="file-table">
                <thead>
                    <tr>
                        <!--triedenie tabulky: https://www.w3schools.com/w3js/w3js_sort.asp-->
                        <td id="file-name" onclick="w3.sortHTML('#file-table','.table-item', 'td:nth-child(1)')">Názov</td>
                        <td id="file-size" onclick="sortTableNumeric('#file-table','.table-item', 'td:nth-child(2)')">Veľkosť</td>
                        <td id="file-date" onclick="w3.sortHTML('#file-table','.table-item', 'td:nth-child(3)')">Dátum</td>
                    </tr>
                </thead>
                <tbody id = 'tableBody'>
                    <?php
                        require "config.php";

                        $input = $_GET['path'];

                        //osetrenie aby sa nedalo dostat nad priecinok files/
                        if (isset($input) && $input != $defaultPath . ".." && $input != $defaultPath . ".") {

                            //z cesty k suboru sa ostrani /.. a aktualne otvoreny priecinok - posunie sa na nadradeny priecinok
                            if (basename($input) == "..") {
                                $input = substr($input,0,strrpos($input, "/"));
                                $input = substr($input,0,strrpos($input, "/"));
                            }

                            //z cesty k suboru sa ostrani /., zostava v aktualnom priecinku
                            if (basename($input) == ".") { //z cesty k suboru sa ostrani /.
                                $input = substr($input,0,strrpos($input, "/"));
                            }

                            //naplnenie tabulky s novou cestou - vnoreny priecinok
                            fillTable($input);
                        }
                        else {
                            //naplnenie tabulky s predvolenou cestou - priecinok files/
                            fillTable(substr($defaultPath,0,-1));
                        }
                    ?>
                </tbody>
            </table>

        </section>

        <footer>
            Copyright &copy; 2020 Petra Kirschová<br>
            Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
        </footer>
    </body>
</html>


