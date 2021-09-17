<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

//OAuth a PHPGangsta
require_once 'vendor/autoload.php';

//prihlasovacie udaje o DB
$hostname = "localhost";
$username = "xkirschova";
$password = "nevynadam_jadrovo";
$dbname = "Zadanie3_DB";

//pripojenie do db
$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//google client
$google_client = new Google_Client();
$google_client->setClientId('177902553123-jhpa5nmu3vjk4lp43j3ekjand7pt0qqg.apps.googleusercontent.com');
$google_client->setClientSecret('GKkbbs2hJ6z2LSbo7qU6aSFB');
$google_client->setRedirectUri('http://wt56.fei.stuba.sk:8056/zad3/welcome.php');

$google_client->addScope('email');
$google_client->addScope('profile');

session_start();
