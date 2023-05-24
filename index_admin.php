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

        function checkAdmin()
        {
            $checkAdmin = "SELECT username, password FROM users WHERE username='" . $_POST['username'] . "' AND password='" . $_POST['password'] . "'";

            $result = $GLOBALS['mysqli']->query($checkAdmin);

            if ($result->num_rows === 0) {
                header("Location: index.php", true, 307);
                die();
            }
            setcookie("username", "admin", time() + 86400, "/");
            setcookie("password", "admin", time() + 86400, "/");
        }

        if (isset($_POST['username']) && isset($_POST['password'])) {
            checkAdmin();
        } else {
            if ((!isset($_COOKIE['username']) && !isset($_COOKIE['password']))) {
                checkAdmin();
            }
        }

        ?>

        <form action="index.php">
            <div class="user-profile">
                <div class="login-button-container">
                    <input type="submit" value="Sign out">
                </div>
            </div>
        </form>

        <div class="logo-container">
            <a href="index.php">
                <img src="logo.png" class="logo">
            </a>
        </div>

        <div class="search-container">
            <form class="search-form" action="index_admin.php" method="get">
                <input type="text" name="search" placeholder="Search products...">
                <select class="select" name="order">
                    <option value="Nome" <?php if (isset($_GET['order']) && $_GET['order'] === 'Nome') echo 'selected'; ?>>Nome</option>
                    <option value="Prezzo" <?php if (isset($_GET['order']) && $_GET['order'] === 'Prezzo') echo 'selected'; ?>>Prezzo</option>
                    <option value="Quantita" <?php if (isset($_GET['order']) && $_GET['order'] === 'Quantita') echo 'selected'; ?>>Quantità</option>
                </select>
                <input type="submit" value="Search">
            </form>
        </div>

        <div class="add-button-container">
            <form action="modify_product.php" method="post">
                <input type="submit" name="add" value="Add Product">
            </form>
        </div>
        <div class="card-container">
            <?php
            include "connect.php";

            if (isset($_GET['search'])) {
                $searchTerm = $_GET['search'];
                $order = isset($_GET['order']) ? $_GET['order'] : 'Nome'; // Get the selected order or default to 'name'
                $selectProdotti = "SELECT * FROM prodotto WHERE nome LIKE '%$searchTerm%' ORDER BY $order";
                // Crea la query con il termine ricercato e l'ordine selezionato
            } else {
                $order = isset($_GET['order']) ? $_GET['order'] : 'Nome'; // Get the selected order or default to 'name'
                $selectProdotti = "SELECT * FROM prodotto ORDER BY $order ";
                // Crea la query con tutti i prodotti e l'ordine selezionato
            }

            $result = $mysqli->query($selectProdotti);

            if ($result->num_rows == 0) {
                echo "<div class='card'>
                        <div class='card-content'>
                            <h2>Prodotto non trovato nel catalogo</h2>
                        </div>
                    </div>";
                exit();
            }

            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>
                        <div class='card-content'>
                            <h3>" . $row["nome"] . "</h3>
                            <h4>ID prodotto: " . $row["id_prodotto"] . "</h4>
                            <p>Descrizione:<br>" . $row["descrizione"] . "</p>
                            <p>Prezzo:<br>" . $row["prezzo"] . "€</p>
                            <p>Quantitá:<br>" . $row["quantita"] . " pezzi</p>
                            <img src='img/" . $row["image"] . "'>
                            <div class='button-container'>
                                <form action='modify_product.php' method='get'>
                                    <input type='hidden' name='product_id' value='" . $row["id_prodotto"] . "'>
                                    <input type='submit' value='Modify Product'>
                                </form>
                                <form action='delete_product.php' method='get'>
                                    <input type='hidden' name='product_id' value='" . $row["id_prodotto"] . "'>
                                    <input type='submit' value='Delete Product'>
                                </form>
                            </div>
                        </div>
                    </div>";
            }

            $mysqli->close();
            ?>
        </div>
    </div>
</body>

</html>