<?php
$mysqli = new mysqli("localhost", "php", "");
$mysqli->select_db("Esercitazione");

if ($mysqli->connect_errno) {
    echo "connesione fallita a mysql " . $mysqli->connect_error();
    exit();
}
?>