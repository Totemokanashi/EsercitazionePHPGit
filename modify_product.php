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
                    session_start(); 

                    include "connect.php";

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
                        <form action='queryes.php' method='post'>
                            <h3>Nome Prodotto</h3>
                            <textarea name='id_prodotto' style='display: none  ;visibility:hidden;' >".$row["id_prodotto"]."</textarea>
                            <textarea name='nome' placeholder='Nome Prodotto' rows='3'>".$row["nome"]."</textarea>
                            <h3>Descrizione</h3>
                            <textarea name='descrizione' placeholder='Descrizione' rows='3'>".$row["descrizione"]."</textarea>
                            <h3>Prezzo</h3>
                            <textarea name='prezzo' placeholder='Prezzo' rows='3'>".$row["prezzo"]."</textarea>
                            <h3>Quantitá</h3>
                            <textarea name='quantita' placeholder='Quantitá' rows='3'>".$row["quantita"]."</textarea>
                            <div class='drop-container'>
                                <h3>Replace the image dragging a new one</h3>
                                <textarea name='image' style='display: none  ;visibility:hidden;' >".$row["image"]."</textarea>
                                <img id='image' class='image-product' ondrop='dropHandler(event);' ondragover='dragOverHandler(event);' ondragleave='dragLeaveHandler(event);' src='img/" . $row["image"] . "'>
                            </div>
                            <div class='button-container'>
                                <input type='submit' name='modify' value='Confirm'>
                            </div>
                        </form>";  
                        
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>