<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <title>MENINY</title>
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
                    <li class="active nav-item"><a href="index.php" class="nav-link">MENO PODĽA DÁTUMU</a></li>
                    <li class="nav-item"><a href="date.php" class="nav-link">DÁTUM PODĽA MENA</a></li>
                    <li class="nav-item"><a href="SKHolidays.php" class="nav-link">SLOVENSKÉ SVIATKY</a></li>
                    <li class="nav-item"><a href="CZHolidays.php" class="nav-link">ČESKÉ SVIATKY</a>
                    <li class="nav-item"><a href="memorials.php" class="nav-link">PAMÄTNÉ DNI</a></li>
                    <li class="nav-item"><a href="insert.php" class="nav-link">VLOŽIŤ OSOBU</a></li>
                    <li class="nav-item"><a href="description.php" class="nav-link">POPIS API</a></li>
                </ul>
            </nav>
        </header>

        <div class="form container-fluid mt-5 mb-3">
            <h2>MENO PODĽA DÁTUMU</h2>
            <div class="form-group">
                <label for="dateInput">Zadajte dátum: </label>
                <input type="date" class="form-control" id="dateInput" name="dateInput">
            </div>
            <div class="form-group">
                <label for="stateSelect">Vyberte štát: </label>
                <select id="stateSelect" class="form-control" name="stateSelect">
                    <option value=""></option>
                    <option value="SK">SK</option>
                    <option value="SKd">SKd</option>
                    <option value="CZ">CZ</option>
                    <option value="HU">HU</option>
                    <option value="PL">PL</option>
                    <option value="AT">AT</option>
                </select>
            </div>
            <button class="btn btn-success" onclick="getName()">ZOBRAZIŤ MENO</button>
        </div>

        <div id="name-output" class="output container-fluid mb-5">

        </div>

        <footer>
            Copyright &copy; 2020 Petra Kirschová<br>
            Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
        </footer>

    </body>
</html>