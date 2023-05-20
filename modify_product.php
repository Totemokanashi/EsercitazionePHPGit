<!DOCTYPE html>
<html>
<head>
    <title>Esercitazione PHP Git</title>
    <link rel="stylesheet" type="text/css" href="modify_product.css">
    <script src="dragAndDrop.js"></script>
</head>

<body>
    <div class="main-container">
        <div class="logo-container">
            <a href="index.php">
                <img src="logo.png" class="logo">
            </a>
        </div>
        <div class='box'>
            <div class='box-content'>
                <?php 
                    $mysqli = new mysqli("localhost", "php", "");
                    $mysqli->select_db("Esercitazione");
                    if ($mysqli->connect_errno) {
                        echo "connesione fallita a mysql " . $mysqli->connect_error;
                        exit();
                    }
                    $modifyProduct = "SELECT * FROM prodotto WHERE id_prodotto =".$_GET['product_id'];
                    $result = $mysqli->query($modifyProduct);
                    if (!$result) {
                        echo "Could not successfully run query ($sql) from DB: " . mysql_error();
                        exit();
                    }
                
                    if ($result->num_rows == 0) {
                        echo "No rows found, nothing to print so am exiting";
                        exit();
                    }        
                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <form action='index_admin.php' method='post'>
                                <h3>Nome Prodotto</h3>
                                <textarea name='Nome Prodotto' placeholder='Nome Prodotto' rows='3'>".$row["nome"]."</textarea>
                                <h4>ID prodotto</h4>
                                <textarea name='ID prodotto' placeholder='ID prodotto' rows='3'>".$row["id_prodotto"]."</textarea>
                                <p>Descrizione</p>
                                <textarea name='Descrizione' placeholder='Descrizione' rows='3'>".$row["descrizione"]."</textarea>
                                <p>Prezzo</p>
                                <textarea name='Prezzo' placeholder='Prezzo' rows='3'>".$row["prezzo"]."</textarea>
                                <p>Quantitá</p>
                                <textarea name='Quantita' placeholder='Quantitá' rows='3'>".$row["quantita"]."</textarea>
                                <img src='img/" . $row["image"] . "'>
                                <div class='drop-box' id='dropBox' ondrop='dropHandler(event);' ondragover='dragOverHandler(event);' ondragleave='dragLeaveHandler(event);'>
                                  Drag and drop an image here.
                                </div>
                                <div class='button-container'>
                                    <input type='submit' value='Confirm'>
                                </div>
                            </form>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>