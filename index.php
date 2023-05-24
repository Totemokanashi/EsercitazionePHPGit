<!DOCTYPE html>
<html>

<head>
    <title>Esercitazione PHP Git</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="logo.png">
</head>
<script>
    var isOpen = false;
    var popup;

    function openPopup() {
        if (!isOpen) {
            popup = document.getElementById("login-popup");
            popup.style.display = "block";
            isOpen = !isOpen;
            return;
        }
        popup.style.display = "none";
        isOpen = !isOpen;
        return;
    }
</script>

<body>
    <div class="main-container">
        <div class="user-profile">
            <img src="img/pfp.png" class="profile-picture" onclick="openPopup()">
            <div id="login-popup" class="login-popup">
                <h3>Login</h3>
                <form class="login-form" action="index_admin.php" method="post">
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" class="password-input" placeholder="Password">
                    <div class="login-button-container">
                        <input type="submit" value="Login">
                    </div>
                </form>
            </div>
        </div>

        <div class="logo-container">
            <a href="index.php">
                <img src="logo.png" class="logo">
            </a>
        </div>

        <div class="search-container">
            <form class="search-form" action="index.php" method="get">
                <input type="text" name="search" placeholder="Search products...">
                <select class="select" name="order">
                    <option value="Nome" <?php if (isset($_GET['order']) && $_GET['order'] === 'Nome') echo 'selected'; ?>>Nome</option>
                    <option value="Prezzo" <?php if (isset($_GET['order']) && $_GET['order'] === 'Prezzo') echo 'selected'; ?>>Prezzo</option>
                    <option value="Quantita" <?php if (isset($_GET['order']) && $_GET['order'] === 'Quantita') echo 'selected'; ?>>Quantità</option>
                </select>
                <input type="submit" value="Search">
            </form>
        </div>

        <div class="card-container">
            <?php
            include "connect.php";

            setcookie("username", "", time() - 86400);
            setcookie("password", "", time() - 86400);

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
                            </div>
                        </div>";
            }

            $mysqli->close();
            ?>
        </div>
    </div>
</body>

</html>