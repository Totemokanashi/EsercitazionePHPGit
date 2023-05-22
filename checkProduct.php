 <?php
    $id = isset($_POST['id_prodotto']) ? intval($_POST['id_prodotto']) : 0;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $descrizione = isset($_POST['descrizione']) ? $_POST['descrizione'] : '';
    $prezzo = isset($_POST['prezzo']) ? floatval($_POST['prezzo']) : 0.0;
    $quantita = isset($_POST['quantita']) ? intval($_POST['quantita']) : 0;
    $image = isset($_POST['image']) ? $_POST['image'] : '';
    
    // Perform validation on the inputs
    $errors = array();
    
    if (empty($nome)) {
        $errors[] = 'Nome Prodotto is required.';
    }
    
    if (empty($descrizione)) {
        $errors[] = 'Descrizione is required.';
    }
    
    if ($prezzo <= 0) {
        $errors[] = 'Prezzo must be a positive number.';
    }
    
    if ($quantita <= 0) {
        $errors[] = 'Quantitá must be a positive number.';
    }
    
    // Check if there are any validation errors
    if (!empty($errors)) {
        $errorString = implode('\n', $errors);
        echo "<script>alert('".$errorString."'); window.history.go(-1);</script>";
        exit();
    }
 ?>