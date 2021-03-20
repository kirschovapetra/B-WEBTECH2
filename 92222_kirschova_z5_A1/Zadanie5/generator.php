<?php
require "config.php";
//nacitanie parametra z databazy
function getParameter(){
    global $db;

    $query = "SELECT id, a FROM parameters ORDER BY id DESC LIMIT 1";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    if (count($results)>0){
        echo "<BR><b>{$results[0]["a"]}</b><BR>";
        return (int)$results[0]["a"];
    }
    return 1;
}


//podla zdrojaku z 5. prednasky

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header("Connection: keep-alive");
header("Access-Control-Allow-Origin: *");

$lastEventId = $_SERVER["HTTP_LAST_EVENT_ID"];
if (isset($lastEventId) && !empty($lastEventId) && is_numeric($lastEventId)) {
    $lastEventId = intval($lastEventId);
    $lastEventId++;
} else {
    $lastEventId = 0;
}

while (true) {
    //parameter sa nacita z databazy
    $a = getParameter();

    //sin, cos, sin*cos
    $x = $lastEventId;
    $y1 = sin(deg2rad($a*$x))+0.01*rand(1,10);
    $y2 = cos(deg2rad($a*$x))+0.01*rand(1,10);
    $y3 = $y1*$y2;

    $xRow = "data: \"x\": \"{$x}\", ". PHP_EOL;
    $y1Row = "data: \"y1\": \"{$y1}\", ". PHP_EOL;
    $y2Row = "data: \"y2\": \"{$y2}\", ". PHP_EOL;
    $y3Row = "data: \"y3\": \"{$y3}\" ". PHP_EOL;

    $toPrint = "id: {$lastEventId}" . PHP_EOL .
            "data: {". PHP_EOL .
                $xRow . $y1Row . $y2Row . $y3Row .
            "data: }". PHP_EOL .
            PHP_EOL;

    echo $toPrint;
    $lastEventId++;
    ob_flush();
    flush();

    //generuje sa kazdych 0.5 sekund
    usleep(500000);
}



?>