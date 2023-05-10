<html>
    <head>
        <title>Esercitazione PHP Git</title>
    </head>
    <body>
        <table>
            <?php
	    echo "php generated";
            $mysqli = new mysqli("localhost","php","");
            $mysqli ->select_db("prodotti");
            if ($mysqli -> connect_errno) {
                echo "connesione fallita a mysql " . $mysqli -> connect_error;
                exit();
              }
              if ($result = $mysqli -> query("SELECT * FROM prodotto")) {
                echo "righe" . $result -> num_rows;
                // pulisce result
                $result -> free_result();
              }
              
            ?>
            <tr></tr>
        </table>            
    </body>
</html>
