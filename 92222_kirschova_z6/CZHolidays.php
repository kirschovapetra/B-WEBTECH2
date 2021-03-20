<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <title>CZ SVIATKY</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <header>
            <h1>REST - MENINY</h1>
            <nav class="navbar navbar-expand-lg justify-content-center">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="index.php" class="nav-link">MENO PODĽA DÁTUMU</a></li>
                    <li class="nav-item"><a href="date.php" class="nav-link">DÁTUM PODĽA MENA</a></li>
                    <li class="nav-item"><a href="SKHolidays.php" class="nav-link">SLOVENSKÉ SVIATKY</a></li>
                    <li class="active nav-item"><a href="CZHolidays.php" class="nav-link">ČESKÉ SVIATKY</a>
                    <li class="nav-item"><a href="memorials.php" class="nav-link">PAMÄTNÉ DNI</a></li>
                    <li class="nav-item"><a href="insert.php" class="nav-link">VLOŽIŤ OSOBU</a></li>
                    <li class="nav-item"><a href="description.php" class="nav-link">POPIS API</a></li>
                </ul>
            </nav>
        </header>
        <div class="output container-fluid my-5">
            <h2>ČESKÉ SVIATKY</h2>
            <div id="cz-output">
                <script>getOther("CZHolidaysInput=TRUE","CZsviatky","cz-output");</script>
            </div>
        </div>


        <footer>
            Copyright &copy; 2020 Petra Kirschová<br>
            Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
        </footer>

    </body>
</html>