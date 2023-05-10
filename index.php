<html>
    <head>
        <title>Esercitazione PHP Git</title>
    </head>
    <body>
    <?php
	    echo "php generated";
            $mysqli = new mysqli("localhost","php","");
            $mysqli -> select_db("prodotti");

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
            
            if (mysql_num_rows($result) == 0) {
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
            while($row = mysql_fetch_assoc($result)){
                echo "<tr>".$row["id_prodotto"]."</tr>";
                echo "<tr>".$row["Nome"]."</tr>";
                echo "<tr>".$row["Descrizione"]."</tr>";
                echo "<tr>".$row["Prezzo"]."</tr>";
                echo "<tr>".$row["Quantita"]."</tr>";
            }
            echo "</table>";
              
    ?>         
    </body>
</html>
