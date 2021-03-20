<?php
require "config.php";
if (isset($_GET["a"])){
    resetId();
    saveToParameters($_GET["a"]); //ulozenie do databazy
}
else {
    truncateParameters(); //pri spusteni stranky sa vymazu data z databazy
}

//zresetovanie id, aby zacinalo cislovanie od 1
function resetId(){
    global $db;
    $query = "ALTER TABLE parameters auto_increment = 1";
    $db->exec($query);
}
//ulozenie do databazy
function saveToParameters($a) {
    global $db;
    $query = "INSERT INTO parameters(a) VALUES({$a})";
    $db->exec($query);
}
//vymazanie zaznamov
function truncateParameters() {
    global $db;
    $query = "DELETE FROM parameters";
    $db->exec($query);
}

?>

<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <title>Grafy</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="script.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">

    </head>
    <body onload="getCoords()">
        <header>
            <h1>A1 : GONIOMETRICKÉ FUNKCIE</h1>
        </header>

        <div class="form-group container-fluid alpha-input-div">
            <label for="parameter">Zadajte parameter: </label>
            <div class="input-group">
                <input type="number" class="form-control"  id="parameter" name="a" placeholder="a">
                <div class="input-group-append">
                    <button class="btn btn-success" onclick="submitParameter()">ZMENIŤ</button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div id="graph"></div>
        </div>
        <div class="container-fluid d-flex justify-content-center flex-wrap form-group edit-graph-menu">
            <div class="form-check-inline align-middle">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="sin" value="sin" id="sin" onclick="plotGraph()" checked>
                    <label for="sin" class="custom-control-label"> Sin(ax)</label>
                </div>
            </div>
            <div class="form-check-inline align-middle">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="cos" value="cos" id="cos" onclick="plotGraph()" checked>
                    <label for="cos" class="custom-control-label"> Cos(ax)</label>
                </div>
            </div>
            <div class="form-check-inline align-middle">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="sincos" value="sincos" id="sincos" onclick="plotGraph()" checked>
                    <label for="sincos" class="custom-control-label"> Sin(ax) * Cos(ax)</label>
                </div>
            </div>
            <button class="btn btn-danger align-middle" onclick="stop()">STOP</button>
        </div>


        <footer>
            Copyright &copy; 2020 Petra Kirschová<br>
            Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
        </footer>

    </body>
</html>