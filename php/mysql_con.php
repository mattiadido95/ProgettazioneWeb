<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "fantanba";
error_reporting(E_ALL); ini_set('display_errors', 1);

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Errore di connessione (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}

?>