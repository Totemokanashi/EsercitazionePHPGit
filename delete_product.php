<!DOCTYPE html>
<html>
<head>
    <title>Esercitazione PHP Git</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="logo.png">
</head>

<body>
    <div class="main-container">
        <?php 
            include "connect.php";
            
            $product = "SELECT * FROM prodotto WHERE id_prodotto =".$_GET['product_id'];
            $result = $mysqli->query($product);

            $row = $result->fetch_assoc();

            echo "<div class='card'>
                        <div class='card-content'>
                        <h2>SICURO DI VOLER ELIMINARE QUESTO PRODOTTO?<h2>
                            <h3>" . $row["nome"] . "</h3>
                            <h4>ID prodotto: " . $row["id_prodotto"] . "</h4>
                            <p>Descrizione:<br>" . $row["descrizione"] . "</p>
                            <p>Prezzo:<br>" . $row["prezzo"] . "€</p>
                            <p>Quantitá:<br>" . $row["quantita"] . " pezzi</p>
                            <img src='img/" . $row["image"] . "'>
                            <div class='button-container'>
                                <form action='queryes.php' method='post'>
                                    <input type='hidden' name='product_id' value='" . $row["id_prodotto"] . "'>
                                    <input type='submit' name='delete' value='Delete Product'>
                                    <input type='submit' name='home' value='Back to home'>
                                </form>
                            </div>
                        </div>
                    </div>";
        ?>
    </div>
</body>
</html>