<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

//prihlasovacie udaje do DB
$hostname = "localhost";
$username = "xkirschova";
$password = "nevynadam_jadrovo";
$dbname = "Zadanie7_DB";

//pripojenie do db
$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

date_default_timezone_set('Europe/Bratislava');