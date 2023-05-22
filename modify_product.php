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
                    include "connect.php";

                    if(!isset($_POST['add'])){
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
                        $row = $result->fetch_assoc();
                        $id = $row["id_prodotto"];
                        $nome = $row["nome"];
                        $descrizione = $row["descrizione"];
                        $prezzo = $row["prezzo"];
                        $quantita = $row["quantita"];
                        $image = $row["image"];
                        $mode = "modify";
                    }else{
                        $id = 1;
                        $nome = "";
                        $descrizione = "";
                        $prezzo = "";
                        $quantita = "";
                        $image = "img/default";
                        $mode = "add";
                    }   
                    echo "
                        <form action='queryes.php' method='post'>
                            <h3>Nome Prodotto</h3>
                            <textarea name='id_prodotto' style='display: none  ;visibility:hidden;' >".$id."</textarea>
                            <textarea name='nome' placeholder='Nome Prodotto' rows='3'>".$nome."</textarea>
                            <h3>Descrizione</h3>
                            <textarea name='descrizione' placeholder='Descrizione' rows='3'>".$descrizione."</textarea>
                            <h3>Prezzo</h3>
                            <textarea name='prezzo' placeholder='Prezzo' rows='3'>".$prezzo."</textarea>
                            <h3>Quantitá</h3>
                            <textarea name='quantita' placeholder='Quantitá' rows='3'>".$quantita."</textarea>
                            <div class='drop-container'>
                                <h3>Replace the image dragging a new one</h3>
                                <textarea id='image-src' name='image' style='display: none  ;visibility:hidden;' >".$image."</textarea>
                                <img id='image' class='image-product' ondrop='dropHandler(event);' ondragover='dragOverHandler(event);' ondragleave='dragLeaveHandler(event);' src='".$image."'>
                            </div>
                            <div class='button-container'>
                                <input type='submit' name=".$mode." value='Confirm'>
                            </div>
                        </form>";  
                    $mysqli->close(); 
                ?>
            </div>
        </div>
    </div>
</body>
</html>