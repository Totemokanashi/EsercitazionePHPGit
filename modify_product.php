<!DOCTYPE html>
<html>
<head>
    <title>Esercitazione PHP Git</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

    <body style="background">
    <div class='card'>
        <div class='card-content'>
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
                    <h3>Nome Prodotto</h3>
                    <input type='text' name='Nome Prodotto' placeholder='Nome Prodotto' value=".$row["nome"].">
                    <h4>ID prodotto</h4>
                    <input type='text' name='ID prodotto' placeholder='ID prodotto' value=".$row["id_prodotto"].">
                    <p>Descrizione</p>
                    <input type='text' name='Descrizione' placeholder='Descrizione' value=".$row["descrizione"].">
                    <p>Prezzo</p>
                    <input type='text' name='Prezzo' placeholder='Prezzo' value=".$row["prezzo"].">
                    <p>Quantitá</p>
                    <input type='text' name='Quantita' placeholder='Quantita' value=".$row["quantita"].">
                    <img src='img/" . $row["image"] . "'>
                    ";
                }
            ?>
            
        </div>
    </div>

</body>
</html>