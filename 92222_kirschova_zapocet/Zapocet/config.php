<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//prihlasovacie udaje o DB
$hostname = "localhost";
$username = "xkirschova";
$password = "nevynadam_jadrovo";
$dbname = "Zapocet_DB";

//pripojenie do db
$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);