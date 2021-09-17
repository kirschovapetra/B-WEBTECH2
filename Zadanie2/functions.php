<?php
/*pripojenie k databaze a praca s sql query podla zdrojovych kodov z prednasky:
osoby_pdo_select.php
osoby_pdo_insert.php
osoby_pdo_update.php
osoby_pdo_delete.php
*/

//pripojenie k databaze
require "config.php";
$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


/*******************************************naplnenie rozbalovacich zoznamov*******************************************/
//naplnenie rozbalovacieho zoznamu politickymi stranami
function fillParties($year) {
    global $db;
    //vyber takych politickych stran, ktore boli zvolene v konkretnom volebnom obdobi (roku)
    $query = "SELECT strany.nazov, vysledky.koalicia FROM strany 
    INNER JOIN vysledky ON vysledky.id_strany = strany.id
    INNER JOIN volby ON vysledky.id_volby = volby.id
    WHERE volby.den1 like '{$year}%'";

    $stmt = $db->query($query);
    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ;

    foreach ($options as $option) {
        if ($option['koalicia'] == 1) {
            echo "<option value=\"{$option['nazov']}\">{$option['nazov']} (KOALICIA)</option>";
        }
        else {
            echo "<option value=\"{$option['nazov']}\">{$option['nazov']} (OPOZICIA)</option>";
        }
    }
}

//naplnenie rozbalovacieho zoznamu ministerstvami
function fillMinistries() {
    global $db;
    //vyber vsetkych ministerstiev
    $query = "SELECT * FROM utvary";
    $stmt = $db->query($query);
    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($options as $option) {
        echo "<option value=\"{$option['nazov']}\">{$option['nazov']}</option>";
    }

}

//naplnenie rozbalovacieho zoznamu volebnymi obdobiami
function fillPeriods($per) {
    global $db;

    //vyber vsetkych volieb
    $optionsQuery = "SELECT * FROM volby";
    $optionsStmt = $db->query($optionsQuery);
    $options = $optionsStmt->fetchAll(PDO::FETCH_ASSOC);

    //volebne obdobie (napr 2016 - 2020) sa rozdeli na pole
    $parts = explode(" - ", $per);

    $prevYear = date('Y', strtotime($options[0]['den1']));
    for($i = 1; $i < count($options); $i++) {
        $year = date('Y', strtotime($options[$i]['den1']));

        //po vybere niektoreho obdobia tato volba zostane v zozname vybrana
        if ($parts[0] == $prevYear) {
            echo "<option value=\"{$prevYear} - {$year}\" selected>{$prevYear} - {$year}</option>";
        }
        else {
            echo "<option value=\"{$prevYear} - {$year}\">{$prevYear} - {$year}</option>";
        }
        $prevYear = $year;
    }
}


/**************************************************naplnenie tabuliek**************************************************/
//index.php - tabulka s ministerstvami
function fillMinistriesTable() {
    global $db;

    //oblast, meno, datum od a do
    $query = "SELECT 
                CASE
                    WHEN utvary.nazov LIKE '%školstva%' THEN 'školstvo'
                    WHEN utvary.nazov LIKE '%zdravotníctva%' THEN 'zdravotníctvo'
                    WHEN utvary.nazov LIKE '%financií%' THEN 'financie'
                    WHEN utvary.nazov LIKE '%dopravy%' THEN 'doprava'
                    ELSE 'iné'
                END AS oblast,
                utvary.nazov AS ministerstvo, 
                osoby.meno AS minister,
                osoby.datumOD AS od,
                osoby.datumDO AS do 
                FROM utvary
                INNER JOIN osoby 
                ON osoby.id_utvary = utvary.id";

    $stmt = $db->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $result) {
        echo "<tr class='table-item'>";
        echo "<td>{$result['oblast']}</td>";
        echo "<td>{$result['ministerstvo']}</td>";
        echo "<td>{$result['minister']}</td>";
        echo "<td>{$result['od']}</td>";
        echo "<td>{$result['do']}</td>";

        /*vypocet poctu dni ministra vo funkcii
        podla https://www.geeksforgeeks.org/program-to-find-the-number-of-days-between-two-dates-in-php/ */
        $endDate = ($result['do']) ? $result['do'] : date("Y-m-d");
        $diff = strtotime($endDate) - strtotime($result['od']);
        $days = abs(round($diff / 86400));

        echo "<td>{$days}</td>";
        echo "</tr>";
    }
}

//parties.php - tabulka s politickymi stranami a vladami
function fillPartiesTable()
{
    global $chairsCount, $db, $period;
    $parts = explode(" - ", $period);

    $query = "SELECT distinct
    strany.nazov, strany.skratka, vysledky.kresla, vysledky.koalicia, vlady.id_volby
    FROM strany
    INNER JOIN vysledky ON vysledky.id_strany = strany.id
    INNER JOIN volby ON vysledky.id_volby = volby.id
    INNER JOIN vlady ON vlady.id_volby = volby.id 
    WHERE volby.den1 like '{$parts[0]}%'
    ";

    $stmt = $db->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $result) {

        $rowColor = "white";

        if ($result['koalicia']) {
            $chairsCount += $result['kresla'];
            $rowColor = "grey";
        }

        echo "<tr class='table-item {$rowColor}'>";
        echo "<td>{$result['nazov']}</td>";
        echo "<td>{$result['skratka']}</td>";
        echo "<td>{$result['kresla']}</td>";
        echo "</tr>";
    }
}
function fillPeriodTable() {
    global $db, $period, $vladaCount;

    $parts = explode(" - ", $period);

    $query = "SELECT distinct
    vlady.id_volby, vlady.datumOD, vlady.datumDO
    FROM vysledky 
    INNER JOIN volby ON vysledky.id_volby = volby.id
    INNER JOIN vlady ON vlady.id_volby = volby.id 
    WHERE volby.den1 like '{$parts[0]}%'
    ";

    $stmt = $db->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $vladaCount = count($results);

    foreach ($results as $result) {
        $rowColor = "white";

        echo "<tr class='table-item {$rowColor}'>";
        echo "<td>{$period}</td>";
        echo "<td>{$result['datumOD']}</td>";
        echo "<td>{$result['datumDO']}</td>";
        echo "</tr>";
    }

}

//edit.php - tabulky pre vlady a ministrov v poslednom volebnom obdobi
function makeEndPeriodTable()
{
    global $db;

    //id poslednych volieb
    $id_volbyMax = $db->query("SELECT MAX(id_volby) as maxID FROM vlady;")->fetch(PDO::FETCH_ASSOC)[maxID];

    //posledne 2 datumy volieb => volebne obdobie od-do
    $lastDates = getLastDates();

    //posledne volebne obdobie
    $lastPeriod =  getPeriod($lastDates);
    $newPeriod = explode(' - ',$lastPeriod)[1] . " +";

    //vyber vlad v poslednom volebnom obdobi
    $query = "SELECT
    vlady.datumOD, vlady.datumDO,vlady.id_volby
    FROM vlady 
    INNER JOIN volby ON vlady.id_volby = volby.id
    WHERE vlady.id_volby in ({$id_volbyMax},{$id_volbyMax}-1)";

    $stmt = $db->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Vlády v posledných volebných obdobiach: </h2>
              <table id='table_id' class='display' style='width:60%'>
                <thead>
                <tr>
                    <th>Obdobie</th>
                    <th>Od</th>
                    <th>Do</th>
                </tr>
                <tr id='filters'>
                    <th>Obdobie</th>
                    <th>Od</th>
                    <th>Do</th>
                </tr>
                </thead>
                <tbody>";

    foreach ($results as $result) {

        echo "<tr class='table-item'>";
        if ($result['id_volby'] == $id_volbyMax){
            echo "<td>{$newPeriod}</td>";
        }
        else {
            echo "<td>{$lastPeriod}</td>";
        }
        echo "<td>{$result['datumOD']}</td>";
        echo "<td>{$result['datumDO']}</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
}
function makeEndMinistriesTable($endDate)
{
    global $db;

    //posledne 2 datumy volieb => volebne obdobie od-do
    $lastDates = getLastDates();

    //posledne volebne obdobie
    $lastPeriod = getPeriod($lastDates);

    //vyber ministrov, ktori skoncili posobenie ukoncenim aktualnej vlady
    $query = "SELECT
        osoby.meno,osoby.datumOD, osoby.datumDO
        FROM vlady 
        INNER JOIN volby ON vlady.id_volby = volby.id
         INNER JOIN osoby ON osoby.id_vlady = vlady.id
        WHERE osoby.datumDO='{$endDate}'";

    $stmt = $db->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Ministri v poslednom volebnom obdobi: </h2>
                  <table id='table_id2' class='display' style='width:60%'>
                    <thead>
                    <tr>
                        <th>Obdobie</th>
                        <th>Meno</th>
                        <th>Od</th>
                        <th>Do</th>
                    </tr>
                    <tr id='filters2'>
                        <th>Obdobie</th>
                        <th>Meno</th>
                        <th>Od</th>
                        <th>Do</th>
                    </tr>
                    </thead>
                    <tbody>";

    foreach ($results as $result) {

        echo "<tr class='table-item'>";
        echo "<td>{$lastPeriod}</td>";
        echo "<td>{$result['meno']}</td>";
        echo "<td>{$result['datumOD']}</td>";
        echo "<td>{$result['datumDO']}</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
}


/**********************************************uprava databazy (edit.php)**********************************************/
//zmenit koaliciu
function change($name,&$status,$period){
    global $db,$koalicia;
    $parts = explode(" - ", $period);

    //vyber datumu volieb, v ktorom bola konkretna strana zvolena
    $den1_query = "SELECT den1 from volby 
                INNER JOIN vysledky on vysledky.id_volby = volby.id
                INNER JOIN strany on vysledky.id_strany = strany.id
                WHERE strany.nazov = '{$name}' AND volby.den1 LIKE '{$parts[0]}%'";
    $stmt = $db->query($den1_query);
    $den1_res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $den1 = $den1_res[0]['den1'];

    $toSet = isset($koalicia) ? 1 : 0;


    $query = "UPDATE vysledky SET vysledky.koalicia = {$toSet} 
                WHERE vysledky.id_strany in (SELECT id from strany where strany.nazov = '{$name}') 
                AND vysledky.id_volby in (select id from volby where volby.den1 = '{$den1}')";

    $link = "parties.php?period=".$parts[0]."+-+".$parts[1]."&submit=zobrazit";
    redirect($link,$db->exec($query),$status);
}

//pridat ministra
function add($name,&$status){
    global $db,$ministry,$addDate;
    $idStranyQuery = "SELECT id from utvary where nazov='{$ministry}'" ;
    $idStranyQueryStmt = $db->query($idStranyQuery);
    $idStranyResults = $idStranyQueryStmt->fetchAll(PDO::FETCH_ASSOC);

    $idVladyQuery = "SELECT max(id) as maxId from vlady" ;
    $idVladyQueryStmt = $db->query($idVladyQuery);
    $idVladyResults = $idVladyQueryStmt->fetchAll(PDO::FETCH_ASSOC);


    $duplicatesQuery = "SELECT id from osoby where meno='{$name}'" ;
    $duplicatesQueryStmt = $db->query($duplicatesQuery);
    $duplicatesResults = $duplicatesQueryStmt->fetchAll(PDO::FETCH_ASSOC);


    if (count($duplicatesResults)>0) {
        $query = "UPDATE osoby SET id_utvary = {$idStranyResults[0]['id']}, datumOD='{$addDate}', datumDO=NULL WHERE meno='{$name}'";
    }
    else {
        $query = "INSERT INTO osoby(meno,id_utvary,id_vlady,datumOD,datumDO) VALUES('{$name}','{$idStranyResults[0]['id']}','{$idVladyResults[0]['maxId']}','{$addDate}',NULL)";

    }

    redirect("index.php",$db->exec($query),$status);

}

//zmazat ministra
function delete($name,&$status){
    global $db;
    $query = "DELETE FROM osoby WHERE meno = '{$name}'";

    redirect("index.php",$db->exec($query),$status);

}

//ukoncit volebne obdobie
function endPeriod(&$status) {
    global $db;
    $today = date("Y-m-d");

    $vladyMaxID = $db->query("SELECT MAX(id) as maxID FROM vlady;")->fetch(PDO::FETCH_ASSOC)[maxID];
    $volbyMaxID = $db->query("SELECT MAX(id) as maxID FROM volby;")->fetch(PDO::FETCH_ASSOC)[maxID];

    $vladyUpdateQuery = "UPDATE vlady SET datumDO = '{$today}' WHERE id={$vladyMaxID}";
    $osobyUpdateQuery = "UPDATE osoby SET datumDO = '{$today}' WHERE id_vlady={$vladyMaxID} and datumDO is NULL";
    $vladyAddQuery = "INSERT INTO vlady(id_volby,datumOD) VALUES({$volbyMaxID},'{$today}')";

    $duplicatesQuery = "SELECT datumOD from vlady where id_volby={$volbyMaxID} AND datumOD = '{$today}'" ;
    $duplicatesQueryStmt = $db->query($duplicatesQuery);
    $duplicatesResults = $duplicatesQueryStmt->fetchAll(PDO::FETCH_ASSOC);


    $count1 = $db->exec($vladyUpdateQuery);
    $count2 = $db->exec($osobyUpdateQuery);
    $count3 = 0;

    if (count($duplicatesResults)==0) {
        $count3 = $db->exec($vladyAddQuery);
    }

    $status =  "Vlady update: {$count1}, Osoby update: {$count2}, Vlady insert: {$count3}";

    makeEndPeriodTable();
    makeEndMinistriesTable($today);
}


/********************************************************ostatne*******************************************************/
function redirect($link, $count,&$status) {
    $status = "Počet zmenených riadkov: {$count}";
    if ($count>0) {
        header("refresh:2; url={$link}");
    }
}

function getLastDates(){
    global $db;
    return $db->query("SELECT den1 FROM volby ORDER BY id DESC LIMIT 2")->fetchAll(PDO::FETCH_ASSOC);
}
function getPeriod($lastDates){
    $date1_parts = explode("-", $lastDates[1]['den1']);
    $date2_parts = explode("-", $lastDates[0]['den1']);

    //obdobie v tvare {zaciatocny rok} - {koncovy rok}
    return $date1_parts[0] . " - " . $date2_parts[0];
}