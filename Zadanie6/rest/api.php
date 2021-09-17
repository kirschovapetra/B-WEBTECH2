<?php
//include "../config.php";
header("Content-Type:application/json");

$method = $_SERVER['REQUEST_METHOD'];
$allStates = ["SK", "SKd", "CZ", "PL", "HU", "AT"];

if ($method == "GET") { //GET na ziskavanie dat

    //nacianie xml, prevod na json array
    $xmlFile = file_get_contents("meniny.xml");
    $xmlString = simplexml_load_string($xmlFile) or die("Error");
    $jsonString = json_encode($xmlString);
    $jsonArray = json_decode($jsonString, TRUE);
    $records = $jsonArray["zaznam"];

    if (isset($_GET["search"]) && $_GET["search"] == "name") { //hladanie mena
        findName($records);
    }
    else if (isset($_GET["search"]) && $_GET["search"] == "date") { //hladanie datumu
        findDate($records);
    }
    else if (isset($_GET["search"]) && $_GET["search"] == "other") { //hladanie sviatkov/pamatnych dni
        findOther($records);
    }
}
else if ($method == "POST") { //POST na vkladanie dat
    if (isset($_GET["insert"]) && $_GET["insert"] == "name") { //vlozenie mena
        insertName($_POST["nameInput"],$_POST["dateInput"]);
    }
}

//najde v akom state sa nachadza meno v konkretnom zazname
function getState($record,$name) {
    global $allStates;

    foreach ($allStates as $stateName) {
        if (!empty($record[$stateName])) {
            $currentNames = explode(", ",$record[$stateName]);
            if (in_array($name,$currentNames)){
                return $stateName;
            }
        }
    }
}

/******************************* hladanie mena *******************************/

function findName($records){
    $date = $_GET["dateInput"];
    $state = $_GET["stateInput"];

    //vyplnene vsetko
    if (isset($date) && !empty($date) && isset($state) && !empty($state)) {
        findNameByDateState($records,$date,$state);
    }
    //vyplneny datum
    else if (isset($date) && !empty($date)) {
        findNameByDate($records,$date);
    }
    //vyplneny stat
    else if (isset($state) && !empty($state)) {
        findNameByState($records,$state);
    }
    //nie je nic vyplnene
    else {
        findAll($records);
    }
}

function findNameByDate($records,$date) {
    global $allStates;
    $output = array();
    foreach ($records as $record) {
        if ($record["den"] == $date) { //najde zaznam s datumom = $date
            foreach ($allStates as $stateName) { //pre konkretny datum vlozi do $output kazde meno, kazdy stat a datum
                array_push($output,["name" => $record[$stateName], "state" => $stateName, "date" => $date]);
            }
        }
    }
    echo json_encode($output);
}
function findNameByState($records,$state) {
    $output = array();

    foreach ($records as $record) { //pre konkretny stat vlozi do $output kazde meno, stat a kazdy datum
        array_push($output,["name" => $record[$state], "state" => $state, "date" => $record["den"]]);
    }
    echo json_encode($output);
}
function findNameByDateState($records,$date, $state) {
    $output = array();

    foreach ($records as $record) {
        if ($record["den"] == $date) { //pre konkretny datum a stat vlozi meno, stat a datum - iba 1 zaznam
            array_push($output,["name" => $record[$state], "state" => $state, "date" => $date]);
        }
    }
    echo json_encode($output);
}

/***************************** hladanie datumu ******************************/

function findDate($records){
    $name = $_GET["nameInput"];
    $state = $_GET["stateInput"];

    //vyplnene vsetko
    if (isset($name) && !empty($name) && isset($state) && !empty($state)) {
        findDateByNameState($records,$name,$state);
    }
    //vyplnene iba meno
    else if (isset($name) && !empty($name)) {
        findDateByName($records,$name);
    }
    //vyplneny iba stat
    else if (isset($state) && !empty($state)) {
        findDateByState($records,$state);
    }
    //nie je nic vyplnene
    else {
        findAll($records);
    }
}

function findDateByName($records,$name) {
    $output = array();

    foreach ($records as $record) {
        $stateName = getState($record,$name); //najde stat, v ktorom sa nachadza meno $name
        if (!empty($stateName)) { //pre konkretne meno vlozi do $output meno, kazdy stat a kazdy datum
            array_push($output,["name" => $record[$stateName], "state" => $stateName, "date" => $record["den"]]);
        }
    }
    echo json_encode($output);
}
function findDateByState($records,$state) {
    $output = array();

    foreach ($records as $record) { //pre konkretny stat vlozi do $output kazde meno, stat a kazdy datum
        array_push($output,["name" => $record[$state], "state" => $state, "date" => $record["den"]]);
    }
    echo json_encode($output);
}
function findDateByNameState($records,$name, $state) {
    $output = array();

    foreach ($records as $record) {
        $currentNames = explode(", ",$record[$state]); //ziska sa pole mien pre zaznam, porovnava sa, ci sa $name v tomto poli nachadza
        if (in_array($name,$currentNames)) { //pre konkretne meno a stat vlozi do $output meno, stat a datum - iba 1 zaznam
            array_push($output,["name" => $record[$state], "state" => $state, "date" => $record["den"]]);
        }
    }
    echo json_encode($output);
}

/***** vsetky mena, staty a datumy - ak neboli vyplnene ziadne parametre *****/

function findAll($records) {

    global $allStates;
    $output = array();

    foreach ($records as $record) {
        $currentNames = array(); //pole, ktore obsahuje meno a stat pre konkretny zaznam
        foreach ($allStates as $stateName) {
            if (!empty($record[$stateName])) {
                array_push($currentNames,["name" => $record[$stateName], "state" => $stateName]);
            }
        }
        //pre kazdy datum sa do $output vlozi $currentNames = pole mien a statov
        array_push($output,["date" => $record["den"],"currentNames" => $currentNames]);
    }
    echo json_encode($output);
}

/********************* hladanie sviatkov/pamatnych dni *********************/

function findOther($records) {
    $tagName = "";

    if (isset($_GET["SKHolidaysInput"]) && !empty($_GET["SKHolidaysInput"])) {
        $tagName = "SKsviatky";
    }
    else if (isset($_GET["CZHolidaysInput"]) && !empty($_GET["CZHolidaysInput"])) {
        $tagName = "CZsviatky";
    }
    else if (isset($_GET["memorialsInput"]) && !empty($_GET["memorialsInput"])) {
        $tagName = "SKdni";
    }

    $output = array();

    foreach ($records as $record) {
        //uklada sa datum a nazov sviatku/pamatneho dna podla toho, aky parameter je vyplneny (SKHolidaysInput,CZHolidaysInput,memorialsInput)
        if (!empty($record[$tagName])) {
            array_push($output, ["date" => $record["den"],$tagName => $record[$tagName]]);
        }
    }
    echo json_encode($output);

}

/***************************** vkladanie mena *****************************/

function insertName($nameInput,$dateInput) {
    /*    podla https://stackoverflow.com/questions/194574/inserting-data-in-xml-file-with-php-dom
               https://stackoverflow.com/questions/1193528/how-to-modify-xml-file-using-php
    */

    //nacitanie xml
    $xmldoc = new DOMDocument();
    $xmldoc->load('meniny.xml');
    $records = $xmldoc->getElementsByTagName("zaznam");

    $msg = "Pri vkladaní mena nastala chyba.";

    if (isset($nameInput) && !empty($nameInput) && isset($dateInput) && !empty($dateInput)) {

        foreach ($records as $record) {
            if ($record->getElementsByTagName("den")[0]->nodeValue == $dateInput) { //nasiel sa zaznam s rovnakym datumom,aky je vstup ($dateInput)

                if (!empty($record->getElementsByTagName("SKd")[0]->nodeValue)) {  //nasiel sa tag SKd => upravuje sa existujuci
                    $SKdElementContent = $record->getElementsByTagName("SKd")[0]->nodeValue; //obsah <SKd>
                    $currentNames = explode(", ",$SKdElementContent);
                    if (!in_array($nameInput,$currentNames)) { //v SKd sa este nenachadza meno $nameInput => vlozi sa
                        $record->getElementsByTagName("SKd")[0]->nodeValue = $SKdElementContent . ", " . $nameInput;
                        $msg = "Bol upravený element SKd: dátum = {$dateInput}, pridané meno = {$nameInput}";
                    } else { //v SKd sa uz nachadza meno $nameInput => nevklada sa duplicitne
                        $msg = "Pre dátum = {$dateInput} už existuje meno '{$nameInput}'";
                    }
                }
                else { //nenasiel sa tag SKd => prida sa novy tag <SKd> s menom $nameInput
                    $newSKdElement = $xmldoc->createElement("SKd");
                    $newSKdElement->nodeValue = $nameInput;
                    $record->appendChild($newSKdElement);
                    $msg = "Bol pridaný nový element SKd: dátum = {$dateInput}, pridané meno = {$nameInput}";
                }
            }
        }
        $xmldoc->save('meniny.xml');

        echo json_encode(["message" => $msg]); //sprava o uspesnom/neuspesnom vlozeni mena
    }
}
