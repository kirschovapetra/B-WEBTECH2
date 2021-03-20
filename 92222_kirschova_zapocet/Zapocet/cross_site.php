<?php
include "config.php";

function badSearch() {
    global $db;
    if (!empty($_POST['searchButton'])) {

        echo "<br><b>Vyhľadávaná položka:</b> {$_POST['searchInput']} <br>";

        $query = "SELECT * FROM inventory WHERE name='{$_POST['searchInput']}'";
        try {
            $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                echo "{$result['name']}: {$result['price']}€ {$result['amount']} ks<br>";
            }
        }
        catch( PDOException $exception ) {
            echo "chyba";
        }
    }
}


function goodSearch() {
    global $db;
    if (!empty($_POST['searchButton'])) {

        $input = htmlspecialchars($_POST['searchInput']);

        echo "<br><b>Vyhľadávaná položka:</b> {$input} <br>";

        $query = "SELECT * FROM inventory WHERE name='{$_POST['searchInput']}'";
        try {
            $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                echo "{$result['name']}: {$result['price']}€ {$result['amount']} ks<br>";
            }
        }
        catch( PDOException $exception ) {
            echo "Položka sa nenachádza v inventári";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Cross-site scripting</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header class="navbar navbar-default">
    <h1 class="text-center">Cross-site scripting</h1>
    <nav class="navbar navbar-expand-lg">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a href="index.php" class="nav-link">SQL Injection</a></li>
            <li class="active nav-item"><a href="cross_site.php" class="nav-link">Cross-site scripting</a></li>
            <li class="nav-item"><a href="exec.php" class="nav-link">Externý program</a></li>
        </ul>
    </nav>
</header>

<div class="container-sm mt-5 mb-3 form-container">
<form action="cross_site.php" method="post">
    <div class="form-group">
        <label for="nameInput">Hľadať v inventári: </label>
        <input type="text" class="form-control" id="searchInput" name="searchInput">
    </div>
    <input type="submit" class="btn btn-success" name="searchButton" value="Hľadať">
</form>

    <div>
        <?php

            badSearch();
            //goodSearch();

        ?>
    </div>

</div>
</body>
</html>