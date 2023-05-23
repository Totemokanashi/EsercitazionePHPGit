<?php
$host = "localhost";
$username = "php";
$password = "";
$database = "Esercitazione";

// Crea l'oggetto mysqli per interfacciarsi con il database
$mysqli = new mysqli($host, $username, $password, $database);

// Controlla se la connessione ha errori
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}
?>