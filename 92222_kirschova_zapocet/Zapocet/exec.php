<?php
include "config.php";

function badExec() {
    if (!empty($_POST["execButton"])) {
        $toExec = "man ".$_POST["execInput"];
        echo "Vykoná sa príkaz: {$toExec}";
        exec($toExec, $output, $return);
        echo "<pre>";
        foreach ($output as $row){
            echo $row."<br>";
        }
        echo "</pre>";
    }
}

function goodExec() {


    if (!empty($_POST["execButton"])) {
        $toExecEscaped = "man ".escapeshellcmd($_POST["execInput"]);


        if (strpos($toExecEscaped, "\;") !== false)
            $toExec = substr($toExecEscaped, 0, strpos($toExecEscaped, "\;"));
        else
            $toExec = $toExecEscaped;

        echo "Vykoná sa príkaz: {$toExec}";
        exec($toExec, $output, $return);
        echo "<pre>";
        foreach ($output as $row){
            echo $row."<br>";
        }
        echo "</pre>";
    }

}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Externý program</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header class="navbar navbar-default">
    <h1 class="text-center">Aplikácia volajúca externý program</h1>
    <nav class="navbar navbar-expand-lg">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a href="index.php" class="nav-link">SQL Injection</a></li>
            <li class="nav-item"><a href="cross_site.php" class="nav-link">Cross-site scripting</a></li>
            <li class="active nav-item"><a href="exec.php" class="nav-link">Externý program</a></li>
        </ul>
    </nav>
</header>


<div class="container-sm mt-5 mb-3 form-container">
    <form action="exec.php" method="post">
        <div class="form-group">
            <label for="execInput">Zobraziť manuál: </label>
            <input type="text" class="form-control" id="execInput" name="execInput">
        </div>
        <input type="submit" class="btn btn-success" name="execButton" value="Zobraziť">
    </form>
</div>

<div class="container-sm output-container">
    <?php
   // badExec();
    goodExec();
    ?>
</div>
</body>
</html>