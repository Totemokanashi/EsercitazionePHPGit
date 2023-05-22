<?php
include "connect.php";
if (isset($_POST['modify'])){
    $query = "UPDATE prodotto SET nome = '".$_POST['nome']."' , descrizione = '".$_POST['descrizione']."' , prezzo = '".$_POST['prezzo']."' , quantita = '".$_POST['quantita']."' , image = '".$_POST['image']."' WHERE id_prodotto = '".$_POST['id_prodotto']."'";
}else if (isset($_POST['add'])){
    $query = "INSERT INTO prodotto (nome,descrizione,prezzo,quantita,image) VALUES ('".$_POST['nome']."','".$_POST['descrizione']."','".$_POST['prezzo']."','".$_POST['quantita']."','".$_POST['image']."')";
}

$result = $mysqli->query($query);
$mysqli->close();
header("Location: index_admin.php", true, 307);
die();
?>