<?php
include "connect.php";

if (isset($_POST['modify'])) {
    include "checkProduct.php";

    $query = "UPDATE prodotto SET nome = '" . $_POST['nome'] . "' , descrizione = '" . $_POST['descrizione'] . "' , prezzo = '" . $_POST['prezzo'] . "' , quantita = '" . $_POST['quantita'] . "' , image = '" . $_POST['image'] . "' WHERE id_prodotto = '" . $_POST['id_prodotto'] . "'";
} else if (isset($_POST['add'])) {
    include "checkProduct.php";

    $query = "INSERT INTO prodotto (nome,descrizione,prezzo,quantita,image) VALUES ('" . $_POST['nome'] . "','" . $_POST['descrizione'] . "','" . $_POST['prezzo'] . "','" . $_POST['quantita'] . "','" . $_POST['image'] . "')";
} else if (isset($_POST['delete'])) {
    // Prende l'immagine del prodotto che deve essere eliminato
    $getImageQuery = "SELECT image FROM prodotto WHERE id_prodotto = " . $_POST['product_id'];
    $imageResult = $mysqli->query($getImageQuery);

    if ($imageResult && $imageResult->num_rows > 0) {
        $row = $imageResult->fetch_assoc();
        $imageFilename = $row['image'];

        if ($imageFilename != 'default.png') {
            // elimina l'immagine dalla cartella img solo se non é "default.png"
            $imagePath = "img/" . $imageFilename;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }

    $query = "DELETE FROM prodotto WHERE id_prodotto = " . $_POST['product_id'];
} else {
    header("Location: index_admin.php", true, 307);
    die();
}

$result = $mysqli->query($query);
$mysqli->close();

header("Location: index_admin.php", true, 307);
die();
?>