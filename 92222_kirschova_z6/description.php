<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>POPIS API</title>
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
            <li class="nav-item"><a href="CZHolidays.php" class="nav-link">ČESKÉ SVIATKY</a>
            <li class="nav-item"><a href="memorials.php" class="nav-link">PAMÄTNÉ DNI</a></li>
            <li class="nav-item"><a href="insert.php" class="nav-link">VLOŽIŤ OSOBU</a></li>
            <li class="active nav-item"><a href="description.php" class="nav-link">POPIS API</a></li>
        </ul>
    </nav>
</header>

<div class="description container-fluid my-5">
    <h2>POPIS API</h2>
    <h3>MENÁ:</h3>
    <ul>
        <li><b>METÓDA:</b> GET</li>
        <li><b>ENDPOINT: http://147.175.121.210:8056/zad6/rest/api/names</b><br></li>
        <ul>
            <li><b>Všetky dátumy, štáty a mená:</b> http://147.175.121.210:8056/zad6/rest/api/names?dateInput=&stateInput=</li>
            <li><b>Všetky mená a štáty pre konkréty dátum:</b> http://147.175.121.210:8056/zad6/rest/api/names?dateInput=<b class="green">0629</b>&stateInput=</li>
            <li><b>Všetky mená a dátumy pre konkrétny štát:</b> http://147.175.121.210:8056/zad6/rest/api/names?dateInput=&stateInput=<b class="red">SK</b></li>
            <li><b>Meno pre konkrétny dátum a štát:</b> http://147.175.121.210:8056/zad6/rest/api/names?dateInput=<b class="green">0629</b>&stateInput=<b class="red">SK</b></li>
        </ul>
    </ul>

    <h3>DÁTUMY:</h3>
    <ul>
        <li><b>METÓDA:</b> GET</li>
        <li><b>ENDPOINT: http://147.175.121.210:8056/zad6/rest/api/dates</b></li>
        <ul>
            <li><b>Všetky dátumy, štáty a mená:</b> http://147.175.121.210:8056/zad6/rest/api/dates?nameInput=&stateInput=</li>
            <li><b>Všetky dátumy a štáty pre konkrétne meno:</b> http://147.175.121.210:8056/zad6/rest/api/dates?nameInput=<b class="blue">Petra</b>&stateInput=</li>
            <li><b>Všetky dátumy a mená pre konkrétny štát:</b> http://147.175.121.210:8056/zad6/rest/api/dates?nameInput=&stateInput=<b class="red">SK</b></li>
            <li><b>Dátum pre konkrétne meno a štát:</b> http://147.175.121.210:8056/zad6/rest/api/dates?nameInput=<b class="blue">Petra</b>&stateInput=<b class="red">SK</b></li>
        </ul>
    </ul>
    <h3>SVIATKY A PAMÄTNÉ DNI:</h3>
    <ul>
        <li><b>METÓDA:</b> GET</li>
        <li><b>ENDPOINT: http://147.175.121.210:8056/zad6/rest/api/other</b></li>
        <ul>
            <li><b>SK sviatky:</b> http://147.175.121.210:8056/zad6/rest/api/other?<b class="purple">SKHolidaysInput=TRUE</b></li>
            <li><b>CZ sviatky:</b> http://147.175.121.210:8056/zad6/rest/api/other?<b class="purple">CZHolidaysInput=TRUE</b></li>
            <li><b>Pamätné dni:</b> http://147.175.121.210:8056/zad6/rest/api/other?<b class="purple">memorialsInput=TRUE</b></li>
        </ul>
    </ul>
    <h3>VKLADANIE MENA:</h3>
    <ul>
        <li><b>METÓDA:</b> POST</li>
        <li><b>ENDPOINT: http://147.175.121.210:8056/zad6/rest/api/insert</b></li>
        <li>Povinné parametre získané z formulára:</li>
        <ul>
            <li>nameInput (meno)</li>
            <li>dateInput (dátum)</li>
        </ul>
    </ul>

    <br><hr>
    <h2>JSON DATA:</h2>
<h3>MENÁ A DÁTUMY:</h3>
    <pre>

<b>Keď je vyplnený aspoň 1 parameter:</b>

    {
        <b>"name"</b>:"Peter, Pavol, Petra",
        <b class="red">"state"</b>:"SK",
        <b class="green">"date"</b>:"0629"
    }
    ...

<b>Keď nie sú vyplnené parametre:</b>

    {
        <b>"date"</b>:"0102",
        <b>"currentNames"</b>: [
            {
                <b>"name"</b>:"Alexandra, Karina",
                <b>"state"</b>:"SK"
            },
            {
                <b>"name"</b>:"Alexandra, Karina, Ábel, Makar, Karin, Kara, Sandra, Saša",
                <b>"state"</b>:"SKd"
            }
            ...
        ]
    }
    ...
    </pre>
<h3>SVIATKY A PAMÄTNÉ DNI:</h3>
    <pre>

    {
        <b>"date"</b>:"0101",
        <b class="purple">"[tag]"</b>:"Deň vzniku Slovenskej republiky"
    }
    ...

    tag = <b class="purple">SKsviatky / CZsviatky / SKdni</b>
    </pre>
<h3>VKLADANIE MENA:</h3>
    <pre>

    {
        <b>"message"</b>: "Bol upravený element SKd: dátum = 0102, pridané meno = Petra"
    }
    </pre>
</div>



<footer>
    Copyright &copy; 2020 Petra Kirschová<br>
    Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
</footer>

</body>
</html>