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
        <title>Ministerstva</title>
    </head>
    <body>
        <header>
            <h1>MINISTERSTVÁ</h1>
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
        <section>
            <h2 class="heading-to-hide">section heading</h2>
            <table id="table_id" class="display" style="width:60%">
                <thead>
                    <tr>
                        <th>Oblasť</th>
                        <th>Ministerstvo</th>
                        <th>Minister</th>
                        <th>Dátum od</th>
                        <th>Dátum do</th>
                        <th>Počet dní</th>
                    </tr>
                    <tr id="filters">
                        <th>Oblasť</th>
                        <th>Ministerstvo</th>
                        <th>Minister</th>
                        <th>Dátum od</th>
                        <th>Dátum do</th>
                        <th>Počet dní</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require "functions.php";
                        fillMinistriesTable();
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

