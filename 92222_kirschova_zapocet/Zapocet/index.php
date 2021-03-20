<?php
include "config.php";

$query = "";

function badLogin($name, $pass) {
    global $db,$query;
    $query = "SELECT * FROM users WHERE name='{$name}' AND pass='{$pass}'";
    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}
function goodLogin($name, $pass) {
    global $db,$query;

    $query = "SELECT * FROM users WHERE name=:name AND pass=:pass";
    $prep = $db->prepare($query);
    $prep->bindParam(':name', $name, PDO::PARAM_STR,100);
    $prep->bindParam(':pass', $pass, PDO::PARAM_STR, 100);
    return $prep->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>SQL Injection</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header class="navbar navbar-default">
    <h1 class="text-center">SQL Injection</h1>
    <nav class="navbar navbar-expand-lg">
        <ul class="nav navbar-nav">
            <li class="active nav-item"><a href="index.php" class="nav-link">SQL Injection</a></li>
            <li class="nav-item"><a href="cross_site.php" class="nav-link">Cross-site scripting</a></li>
            <li class="nav-item"><a href="exec.php" class="nav-link">Externý program</a></li>
        </ul>
    </nav>
</header>

<div class="container-sm mt-5 mb-3 form-container">
    <h2>Login</h2>
    <form action="index.php" method="post">
        <div class="form-group">
            <label for="nameInput">Prihlasovacie meno: </label>
            <input type="text" class="form-control" id="nameInput" name="nameInput">
        </div>
        <div class="form-group">
            <label for="nameInput">Heslo: </label>
            <input type="text" class="form-control" id="passInput" name="passInput">
        </div>
        <input type="submit" class="btn btn-success" name="loginButton" value="Login">
    </form>
    <?php
        if (!empty($_POST["loginButton"])) {
            $name=$_POST["nameInput"];
            $pass=$_POST["passInput"];

            $result = badLogin($name,$pass);
           // $result = goodLogin($name,$pass);
            if (!empty($result)) {
                echo $query."<br>";
                echo "Prístup povolený<br>!!!tajné info!!!";
            }
            else {
                echo "Prístup zamietnutý";
            }
        }

    ?>
</div>

</body>
</html>