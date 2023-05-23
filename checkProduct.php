<?php
$id = isset($_POST['id_prodotto']) ? intval($_POST['id_prodotto']) : 0;
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$descrizione = isset($_POST['descrizione']) ? $_POST['descrizione'] : '';
$prezzo = isset($_POST['prezzo']) ? floatval($_POST['prezzo']) : 0.0;
$quantita = isset($_POST['quantita']) ? intval($_POST['quantita']) : 0;
$image = isset($_POST['image']) ? $_POST['image'] : '';

// Controlla i campi inseriti
$errors = array();

if (empty($nome)) {
    $errors[] = 'il campo nome prodotto risulta mancante.';
}

if (empty($descrizione)) {
    $errors[] = 'Il campo descrizione risulta mancante.';
}

if ($prezzo <= 0) {
    $errors[] = 'Il campo prezzo deve essere un numero positivo.';
}

if ($quantita <= 0) {
    $errors[] = 'Il campo Quantitá deve essere un numero positivo.';
}

// Controlla se ci sono stati errori nei campi inseriti
if (!empty($errors)) {
    $errorString = implode('\n', $errors);
    echo "<script>alert('" . $errorString . "'); window.history.go(-1);</script>";
    exit();
}
?>