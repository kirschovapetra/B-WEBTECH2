<?php

function getFlag($code){
    $codeLower = strtolower($code);
    return "http://www.geonames.org/flags/x/{$codeLower}.gif";
}

function getCities() {
    global $db;
    $query = "SELECT DISTINCT state,code,city,lat,lon FROM visits inner JOIN users ON user_id = users.id";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($results);
}

//https://w3resource.com/php-exercises/php-basic-exercise-5.php
function getIp(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}

//https://ipapi.com/
function getLocation($ip){
    $access_key = '8e5b29f076963529af89b159041b9072';

    $endpoint = 'http://api.ipapi.com/'.$ip.'?access_key='.$access_key;

    //curl
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output = curl_exec($ch);
    curl_close($ch);

    return json_decode($output, true);
}

//https://openweathermap.org/api
function getWeather(){
    $ip = getIp();
    $location = getLocation($ip);

    $endpoint= "https://api.openweathermap.org/data/2.5/weather?lat={$location["latitude"]}&lon={$location["longitude"]}&appid=32091cbf7f581855db72104fda94ab27&units=metric&lang=sk";
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output = curl_exec($ch);
    curl_close($ch);

    return json_decode($output, true);

}

//vrati pouzivatela podla jeho ip
function getUser() {

    global $db;
    $ip = getIp();
    $query = "SELECT * FROM users WHERE ip = '{$ip}'";
    $results = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    return (count($results)>0)? $results[0] : null;
}

//vrati navstevy konkretneho pouzivatela
function getVisits($user) {

    global $db;
    $id = $user["id"];
    $query = "SELECT * FROM users INNER JOIN visits ON visits.user_id = users.id AND users.id = '{$id}'";

    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}


//vlozi noveho pouzivatela
function insertUser() {
    global $db;
    $ip = getIp();
    $state = getLocation($ip)["country_name"];
    $country_code = getLocation($ip)["country_code"];
    $city = getLocation($ip)["city"];
    $lat = getLocation($ip)["latitude"];
    $lon = getLocation($ip)["longitude"];

    if (empty($city))
        $city = "Vidiek";

    if (empty(getUser())) {
        $query = "INSERT INTO users(ip,state,code,city,lat,lon) VALUES('{$ip}','{$state}','{$country_code}','{$city}','{$lat}','{$lon}')";
        $db->exec($query);
    }
}

//zisti, ci bola stranka s nazvom $page dnes navstivena pouzivatelom $user
function visitedToday($user,$page) {
    $visits = getVisits($user);
    $today = date("Y-m-d");

    foreach ($visits as $visit) {
        $dateVisited = explode(" ",$visit["date"])[0];
        if ($dateVisited == $today && $visit["page_name"] == $page)
            return true;
    }
    return false;
}

//vlozi navstevu do databazy
function insertVisit($page) {
    global $db;
    $user = getUser();

    if (!empty($user) && !visitedToday($user,$page)) {
        $id = $user['id'];
        $today = date("Y-m-d");
        $time = date("H:i:s");
        $query = "INSERT INTO visits(page_name,date,time,user_id) VALUES('{$page}','{$today}','{$time}',{$id})";
        $db->exec($query);
    }
}

//ukaze obsah stranky iba ak povolil pristup
function showContent() {

    if (!empty(getUser())){
        echo "<script>document.getElementById('output').style.display = 'block'</script>";
    }
    else {
        echo "<script>document.getElementById('output').style.display = 'none'</script>";
    }
}