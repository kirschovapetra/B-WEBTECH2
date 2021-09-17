<?php
include "config.php";

if(session_status() === PHP_SESSION_NONE) session_start();

session_unset();
unset($_SESSION['meno']);
$google_client->revokeToken();
session_destroy();

echo "Boli ste úspešne odhlásený.";
header("refresh:2; url=index.php");
