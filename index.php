<!DOCTYPE html>
<html>
<head>
    <title>Esercitazione PHP Git</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background">
    <div class="main-container">
        <div class="search-container">
            <form class="search-form"  action="index.php" method="get">
                <input type="text" name="search" placeholder="Search products...">
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="card-container">
            <?php
                $mysqli = new mysqli("localhost","php","");
                $mysqli -> select_db("Esercitazione");
                
                if ($mysqli -> connect_errno) {
                    echo "connesione fallita a mysql " . $mysqli -> connect_error;
                    exit();
                }
                
                if (isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $selectProdotti = "SELECT * FROM prodotto WHERE nome LIKE '%$searchTerm%'";
                    // ...execute the query and display the filtered results
                } else {
                    $selectProdotti = "SELECT * FROM prodotto";
                    // ...execute the query and display all products
                }
                
                $result = $mysqli -> query($selectProdotti);
                if (!$result) {
                    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
                    exit();
                }

                if ($result->num_rows == 0) {
                    echo "No rows found, nothing to print so am exiting";
                    exit();
                }

                while($row = $result -> fetch_assoc()){
                    echo "<div class='card'>
                        <div class='card-content'>
                            <h3>".$row["nome"]."</h3>
                            <h4>ID prodotto: ".$row["id_prodotto"]."</h4>
                            <p>Descrizione:<br>".$row["descrizione"]."</p>
                            <p>Prezzo:<br>".$row["prezzo"]."€</p>
                            <p>Quantitá:<br>".$row["quantita"]." pezzi</p>
                            <img src='img/".$row["image"]."'>
                        </div>
                    </div>";
                }
            
            ?>
        </div>
    </div>
</body>
</html>
