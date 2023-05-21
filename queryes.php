<?php
if (!isset($_POST['modify'])){
    exit();
}

include "connect.php";

$updateProduct = "UPDATE prodotto SET nome = '".$_POST['nome']."' , descrizione = '".$_POST['descrizione']."' , prezzo = '".$_POST['prezzo']."' , quantita = '".$_POST['quantita']."' , image = '".$_POST['image']."' WHERE id_prodotto = '".$_POST['id_prodotto']."'";
$result = $mysqli->query($updateProduct);
header("Location: index_admin.php", true, 307);
die();
?>