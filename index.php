<!DOCTYPE html>
<html>
    <head>
        <title>Esercitazione PHP Git</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body style="background">
        <div class="div">
            <?php
                $mysqli = new mysqli("localhost","php","");
                $mysqli -> select_db("Esercitazione");

                $selectProdotti = "SELECT * FROM prodotto";

                if ($mysqli -> connect_errno) {
                    echo "connesione fallita a mysql " . $mysqli -> connect_error;
                    exit();
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
                echo "<table>
                    <tr>
                        <th>id prodotto</th>
                        <th>Nome Prodotto</th>
                        <th>Descrizione Prodotto</th>
                        <th>Prezzo Prodotto</th>
                        <th>Quantitá Prodotto</th>
                    </tr>";
                while($row = $result -> fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$row["id_prodotto"]."</td>";
                    echo "<td>".$row["nome"]."</td>";
                    echo "<td>".$row["descrizione"]."</td>";
                    echo "<td>".$row["prezzo"]."€</td>";
                    echo "<td>".$row["quantita"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            
            ?>
        </div>
    </body>
</html>
