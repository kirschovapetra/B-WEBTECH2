<?php
/*
udaje preberane z:
https://www.worldometers.info/world-population/population-by-country/
https://github.com/CSSEGISandData/COVID-19/tree/master/csse_covid_19_data/csse_covid_19_daily_reports
*/

require "config.php";
$worldometersOutput = array();
$githubOutput = array();
$allCountries = array();


/****************************************  INFO, STATISTIKY, INICIALIZACIA   ******************************************/

//informacie o pocte krajin, statov a zaznamov v databaze
function getDBInfo(&$countryCount, &$stateCount, &$dataCount){
    global $db;

    $placeQuery = "SELECT COUNT(DISTINCT countryname) AS 'countries', count(DISTINCT statename) AS 'states' 
                    FROM place";
    $placeResults = $db->query($placeQuery)->fetchAll(PDO::FETCH_ASSOC);

    if (count($placeResults)>0){
        $countryCount = $placeResults[0]["countries"];
        $stateCount = $placeResults[0]["states"];
    }

    $dataQuery = "SELECT COUNT(*) AS 'all' FROM data";
    $dataResults = $db->query($dataQuery)->fetchAll(PDO::FETCH_ASSOC);

    if (count($placeResults)>0){
        $dataCount = $dataResults[0]["all"];
    }
}

//kumulativny pocet vsetkych nakazenych, vyliecenych a mrtvych v danej krajine
function getStats(&$illCount, &$healthyCount, &$deadCount,$country){
    global $db;

    //vyber poctu vsetkych nakazenych, vyliecenych a mrtvych v danej krajine
    $query = "SELECT reportdate,countryname,SUM(confirmed) AS 'ill',SUM(recovered) AS 'healthy',SUM(deaths) AS 'dead' 
                FROM data INNER JOIN place ON place.id = place_id WHERE countryname='{$country}' 
                GROUP BY countryname,reportdate 
                ORDER BY reportdate DESC 
                LIMIT 1";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    if (count($results)>0){
        $illCount = $results[0]["ill"];
        $healthyCount = $results[0]["healthy"];
        $deadCount = $results[0]["dead"];
    }
}

//vyprazdnenie tabulky
function truncateTable($tableName){
    global $db,$count;
    $query = "DELETE FROM {$tableName}";
    $db->exec($query);
    if ($tableName=="country"){
        $count = 0;
    }
}

//zresetovanie id, aby zacinalo cislovanie od 1
function resetId($tableName){
    global $db;
    $query = "ALTER TABLE {$tableName} auto_increment = 1";
    $db->exec($query);
}

//vyprazdnenie databazy
function clearDB(){
    truncateTable("data");
    truncateTable("place");
}

//zresetovanie id vo vsetkych tabulkach v databaze
function resetIDs(){
    resetId("data");
    resetId("place");
}

//nacitanie dat a zapis do databazy
function init(&$msg) {
    clearDB();
    $msg.= "<br>Tabulky vyprazdnené";
    resetIDs();
    $msg.= "<br>ID zresetované";
    insertAll($msg);
}

/*****************************************************  GRAFY   *******************************************************/

//pocet nakazenych na 100000 obyvatelov
function getGraph1Data(&$countries,&$ill){

    global $db;
    $countries = array();
    $ill = array();

    //vyber nazvu krajiny, populacie a poctu nakazenych z posledneho zaznamu pe kazdu krajinu
    $query = "SELECT countryname, population, SUM(confirmed) AS 'ill'
        FROM data AS MainData INNER JOIN place ON place_id = place.id 
        WHERE reportdate = ( 
            SELECT MAX(reportdate) FROM data AS SubData 
            WHERE SubData.place_id = MainData.place_id 
            ) 
        GROUP BY countryname,population
        ORDER BY countryname DESC";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    //z kazdeho zaznamu sa zoberie populacia a pocet nakazenych
    $records = array();
    foreach ($results as $result){
        if ($result["population"]>0){
            $cases = 100000.0*$result["ill"]/$result["population"];
        }
        else{
            /*ak v tabulke nie je uvedena populacia, pocet pripadov bude 0 (taketo pripady nastavaju iba zriedka,
            ked sa v datach z Githubu vyskytuje krajina, ktora nie je v tabulke z Worldometers) */
            $cases = 0;
        }
        $records[$result["countryname"]] = $cases;
    }

    $countries = array_keys($records);
    $ill = array_values($records);

}

//percento vyliecenych
function getGraph2Data(&$countries,&$healthy){
    global $db;
    $countries = array();
    $healthy = array();

    //vyber nazvu krajiny, populacie, poctu nakazenych a poctu vyliecenych z posledneho zaznamu pe kazdu krajinu
    $query = "SELECT countryname,population, SUM(confirmed) AS 'ill', SUM(recovered) AS 'healthy' 
        FROM data AS MainData INNER JOIN place ON place_id = place.id 
        WHERE reportdate = ( 
            SELECT MAX(reportdate) FROM data AS SubData 
            WHERE SubData.place_id = MainData.place_id 
            ) 
        GROUP BY countryname,population
        ORDER BY countryname DESC";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $records = array();
    foreach ($results as $result){
        if ($result["healthy"]>0) { //beru sa iba tie zaznamy, ktore mali aspon 1 vylieceneho
            $healthyPercent = $result["healthy"] / $result["ill"] * 100.0;
            $records[$result["countryname"]] = $healthyPercent;
        }
    }

    $countries = array_keys($records);
    $healthy = array_values($records);
}

//percento mrtvych
function getGraph3Data(&$countries,&$dead){
    global $db;
    $countries = array();
    $dead = array();

    //vyber nazvu krajiny, populacie, poctu nakazenych a poctu mrtvych z posledneho zaznamu pe kazdu krajinu
    $query = "SELECT countryname,population, SUM(confirmed) AS 'ill', SUM(deaths) AS 'dead' 
        FROM data AS MainData INNER JOIN place ON place_id = place.id 
        WHERE reportdate = ( 
            SELECT MAX(reportdate) FROM data AS SubData 
            WHERE SubData.place_id = MainData.place_id 
            ) 
        GROUP BY countryname,population
        ORDER BY countryname DESC";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $records = array();
    foreach ($results as $result){
        if ($result["dead"]>0) { //beru sa iba tie zaznamy, ktore mali aspon 1 mrtveho
            $deadPercent = $result["dead"] / $result["ill"] * 100.0;
            $records[$result["countryname"]] = $deadPercent;
        }
    }

    $countries = array_keys($records);
    $dead = array_values($records);
}

//naplnenie rozbalovacieho zoznamu vsetkymi krajinami
function fillCountrySelect(){
    global $db;

    $query = "SELECT DISTINCT countryname FROM place ORDER BY countryname";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $result){
        if (isset($_GET["CountrySubmit"]) && $result["countryname"] == $_GET["Country"]) {
            echo "<option value='{$result["countryname"]}' selected>{$result["countryname"]}</option>";
        }
        else {
            echo "<option value='{$result["countryname"]}'>{$result["countryname"]}</option>";
        }

    }

}

function getGraph4Data(&$dates,&$ill,&$healthy,&$dead,$selectedCountry){
    global $db;
    $dead = array();
    $healthy = array();
    $ill = array();
    $dates = array();

    //vyber datumov, nakazenych, vyliecenych a mrtvych vo vybranej krajine
    $query = "SELECT reportdate, SUM(confirmed) AS 'ill', SUM(recovered) AS 'healthy', SUM(deaths) AS 'dead' 
                FROM data INNER JOIN place ON place.id = place_id
                WHERE countryname = '{$selectedCountry}' 
                GROUP BY reportdate";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);


    foreach ($results as $key => $result){
        array_push($dates,$result["reportdate"]);

        //pri 0. zazname sa ulozia hodnoty aktualneho prvku
        if ($key == 0){
            array_push($ill,(int)$result["ill"]);
            array_push($dead,(int)$result["dead"]);
            array_push($healthy,(int)$result["healthy"]);
        }
        //pre ostatne zaznamy sa uklada rozdiel dat z aktualneho a predchadzajuceho zaznamu (rozdiel medzi 2 datumami)
        else{
            array_push($ill,abs($results[$key]["ill"] - $results[$key-1]["ill"]));
            array_push($dead,abs($results[$key]["dead"] - $results[$key-1]["dead"]));
            array_push($healthy,abs($results[$key]["healthy"] - $results[$key-1]["healthy"]));
        }
    }

}

/********************************************  STIAHNUTIE A UPRAVA DAT   **********************************************/

//uprava nezrovnalosti v nazvoch krajin
function fixCountryName(&$country){
    global $db;
    //premapuje sa povodna hodnota na novu ak sa krajina najde v tabulke 'mapping'
    $countryQuery = "SELECT * FROM mapping WHERE original='{$country}'";
    $countryResults = $db->query($countryQuery)->fetchAll(PDO::FETCH_ASSOC);
    if (count($countryResults)>0){
        $country = $countryResults[0]["replacement"];
    }
}

//uprava dat stiahnutych z githubu
function fixGithubData(){
    global $githubOutput;

    for ($i=0; $i<count($githubOutput); $i++) {
        //formatovanie casu
        $update = $githubOutput[$i]["Update"];
        $reportDate = $githubOutput[$i]["ReportDate"];
        $githubOutput[$i]["Update"] = date("Y-m-d H:i:s", strtotime($update));
        $githubOutput[$i]["ReportDate"] = date("Y-m-d H:i:s", strtotime($reportDate));

        //zjednotenie nazvov lode na 'Cruise Ship'
        if (in_array( $githubOutput[$i]["State"],array("Cruise Ship","Diamond Princess cruise ship","Diamond Princess"))) {
            $githubOutput[$i]["State"] = "Cruise Ship";
        }

        //uprava nazvov krajin
        fixCountryName($githubOutput[$i]["Country"]);
    }
}

//stiahnutie dat zo stranky worldometers
function worldometersDownload(){
    global $worldometersOutput;
    $worldometersOutput = array();
    $worldometersHeaders = array();
    $worldometersUrl = "https://www.worldometers.info/world-population/population-by-country/";

    $init = curl_init();
    curl_setopt($init,CURLOPT_URL,$worldometersUrl);
    curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($init,CURLOPT_CONNECTTIMEOUT,15);

    $curl = curl_exec($init);

    if (!empty($curl)) {
        $webPage = new DOMDocument;
        $webPage->loadHTML($curl);
        $table = $webPage->getElementById("example2");
        $rows = $table->getElementsByTagName("tr");

        foreach ($rows as $row) {

            //prvy riadok - zahlavie tabulky
            if ($row->nodeValue[0]=="#"){
                $first_line = $row->nodeValue;

                //odstrania sa zatvorky (aj s ich obsahom) a percenta
                $pattern = '(([(](.{1,13})[)])|([%]))';
                $first_line = preg_replace($pattern,"",$first_line);

                //ak sa v bunke zahlavia nachadza viacslovny nazov, slova sa spoja do jedneho
                $needles = array(". "," Change"," Area"," Pop"," Share");
                $newValues = array(".","Change","Area","Pop","Share");
                $first_line = str_replace($needles,$newValues,trim($first_line));

                $worldometersHeaders = explode(" ", $first_line);
                array_pop($worldometersHeaders);
                continue;
            }


            $newRow = array();

            //prechadzaju sa vsetky bunky pre kazdy riadok tabulky
            $cells = $row->getElementsByTagName("td");
            foreach ($cells as $key => $val) {
                $needles = array(" %",",","N.A.","&","'","  ");
                $newValues = array("","","","\&","´"," ");
                $cell = trim(str_replace($needles,$newValues,$val->nodeValue));
                fixCountryName($cell);

                //uklada sa nazov krajiny a populacia
                if ($key==1){
                    $newRow["Country"] = $cell;
                }
                else if ($key==2){
                    $newRow["Population"] = (int)$cell;
                }
            }
            array_push($worldometersOutput, $newRow);
        }
    }
}

//stiahnutie csv z githubu
function githubDownload($date){
    global $githubOutput;

    $githubOutput = array();
    $githubUrl = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_daily_reports/{$date}.csv";

    $init = curl_init();
    curl_setopt($init,CURLOPT_URL,$githubUrl);
    curl_setopt($init,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($init,CURLOPT_VERBOSE,true);
    curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($init,CURLOPT_CONNECTTIMEOUT,15);

    $curl = curl_exec($init);

    if (!curl_errno($init)) {
        $lines = array_filter(explode(PHP_EOL, $curl));
        $first_line = str_getcsv($lines[0]);
        $first_line = str_replace("_","/",$first_line);
        $first_line = str_replace(array("Last Update","Last_Update","Last/Update"),array("Update","Update","Update"),$first_line);

        //riadky v csv
        for ($i = 1; $i < count($lines); $i++) {
            $line = str_getcsv($lines[$i]);
            $result = array();

            //polozky v riadku
            foreach ($line as $key => $val) {
                $needles = array(",","&","'");
                $newValues = array("","\&","´");
                $lineItem = str_replace($needles,$newValues,trim($val));

                //ulozenie nacitanych dat do pola
                if (strpos($first_line[$key],"State")!== false) {
                    $result["State"] = trim($lineItem);
                }
                if (strpos($first_line[$key],"Country")!== false) {
                    $result["Country"] = trim($lineItem);
                }
                if (strpos($first_line[$key],"Update")!== false) {
                    $result["Update"] = trim($lineItem);
                }
                if (strpos($first_line[$key],"Confirmed")!== false) {
                    $result["Confirmed"] = (int)$lineItem;
                }
                if (strpos($first_line[$key],"Deaths")!== false) {
                    $result["Deaths"] = (int)$lineItem;
                }
                if (strpos($first_line[$key],"Recovered")!== false) {
                    $result["Recovered"] = (int)$lineItem;
                }
                $result["ReportDate"] =str_replace("-","/",$date);
            }
            //do $githubOutput sa zapise novy zaznam = riadok
            array_push($githubOutput, $result);
        }
        //uprava dat
        fixGithubData();
    }
}

/*********************************************  VLOZENIE DO DATABAZY   ************************************************/

//najde zaznamy v tabulke 'place' so zadanym nazvom statu a krajiny
function duplicatePlace($state,$country){
    global $db;

    $placeQuery = "SELECT * FROM place where statename='{$state}' && countryname='{$country}'";
    $placeResult = $db->query($placeQuery)->fetchAll(PDO::FETCH_ASSOC);

    return count($placeResult);
}

//najde id v tabulke 'place' ktore prislucha nazvu statu a krajiny
function findPlaceId($stateName,$countryName){
    global $db;

    $placeQuery = "SELECT id,statename,countryname FROM place";
    $placeResults = $db->query($placeQuery)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($placeResults as $result){
        if ($result["statename"]==$stateName && $result["countryname"]==$countryName){
            return $result["id"];
        }
    }
    return null;
}

//pridanie github dat do databazy (tab. place)
function insertGithubIntoPlace($output){
    global $db,$allCountries;
    foreach ($output as $row) {
        if (duplicatePlace($row['State'],$row['Country'])>0){
            continue;
        }

        if (!empty($row['State'])) { //ked je vyplneny stat tak sa zapise aj stat, inak iba krajina
            $query = "INSERT INTO place(statename,countryname) VALUES('{$row['State']}','{$row['Country']}')";
        }
        else {
            $query = "INSERT INTO place(countryname) VALUES('{$row['Country']}')";
        }
        array_push($allCountries,$row['Country']);
        $db->exec($query);
    }
}

//pridanie worldmeters dat do databazy (tab. place)
function insertWorldmetersIntoPlace($output){
    global $db,$allCountries;

    foreach ($output as $row) {
        //ak krajina este nie je ulozena, prida sa novy riadok, inak sa iba updatne existujuci zaznam
        if (!in_array($row['Country'],$allCountries)){
            $query = "INSERT INTO place(countryname,population) VALUES('{$row['Country']}',{$row['Population']})";
            array_push($allCountries,$row['Country']);
            $db->exec($query);
        }
        else{
            $query = "UPDATE place SET population = {$row['Population']} WHERE countryname='{$row['Country']}'";
            $db->exec($query);
        }
    }
}

//pridanie github dat do databazy (tab. data)
function insertIntoData($output){
    global $db;

    foreach ($output as $row) {

            $stateName = $row['State'];
            $countryName = $row['Country'];
            $confirmed = $row["Confirmed"];
            $deaths = $row["Deaths"];
            $recovered = $row["Recovered"];
            $update = $row['Update'];
            $reportDate = $row['ReportDate'];

            $placeId = findPlaceId($stateName,$countryName);
            if (empty($placeId)) { //$placeId bude null ak v tabulke place neexistuje zaznam k danemu statu a krajine
                $query = "INSERT INTO data(lastupdate,reportdate,confirmed,deaths,recovered) 
                            VALUES('{$update}','{$reportDate}','{$confirmed}','{$deaths}','{$recovered}')";
            }
            else {
                $query = "INSERT INTO data(lastupdate,reportdate,confirmed,deaths,recovered,place_id) 
                            VALUES('{$update}','{$reportDate}','{$confirmed}','{$deaths}','{$recovered}','{$placeId}')";
            }
            $db->exec($query);
        }

}

//vlozenie vsetkych dat do databazy
function insertAll(&$msg){
    global $githubOutput,$worldometersOutput;

    $firstDate = "2020-01-22";
    $lastDate = "2020-03-21";

    worldometersDownload();
    $msg.= "<br><b>stiahnute z Worldometers</b>";

    //podla: https://stackoverflow.com/questions/45566865/how-to-iterate-between-two-dates-with-php?noredirect=1&lq=1
    $date = $firstDate;

    //prechadzaju sa vsetky datumy a pre kazdy sa ulozia data do tabulky
    while (strtotime($date) <= strtotime($lastDate)) {
        $newDate = date("m-d-Y",strtotime($date));
        githubDownload($newDate);
        insertGithubIntoPlace($githubOutput);
        insertWorldmetersIntoPlace($worldometersOutput);
        insertIntoData($githubOutput);
        $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
    }
    $msg.= "<br><b>stiahnute z Github</b>";
}