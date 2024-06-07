<?php
session_start();
// Uspostavljamo konekciju s bazom podataka
$servername = "localhost";
$username = "root"; // Promijeniti korisničko ime ako je potrebno
$password = ""; // Promijeniti lozinku ako je potrebno
$database = "projekt_php"; // Ime baze podataka u XAMPP-u

$conn = new mysqli($servername, $username, $password, $database);

// Provjera veze
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Izvršavamo upit za dohvat podataka iz baze
$sql = "SELECT naziv, opis, cijena, slika_link FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="Home.css">
    <style>
        .flex-container {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: DodgerBlue;
            height: 100vh;
        }

        .flex-container>div {
            background-color: #f1f1f1;
            width: 100px;
            margin: 10px;
            text-align: center;
            line-height: 75px;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <header id="header">
        <div class="logo"><img src="./images/logo2.jpg"></div>
        <input class="naslovnica" type="button" value="Home" onclick="window.location.href = 'index.php';">
        <input class="kontakt" type="button" value="Contact" onclick="window.location.href = 'kontakti/Contact.php';">
        <input class="o_nama" type="button" value="News" onclick="window.location.href = 'news.php';">
        <input class="kosarica" type="image" src="https://t4.ftcdn.net/jpg/01/86/94/37/360_F_186943704_QJkLZaGKmymZuZLPLJrHDMUNpAwuHPjY.jpg" onclick="window.location.href = 'kosarica.php';">
        <input class="logout" type="button" value="Log Out" onclick="window.location.href = 'login.php';">
        <?php
        if(isset($_SESSION['Admin']) && $_SESSION['Admin'] == 1) {
            echo '<input class="admin" type="button" value="Admin" onclick="window.location.href = \'Table05.php\';">';
        }
        ?>
    </header>

    <div class="glavno">
        <div class="dron"><img src="./images/logo_bicikla.jpg"></div>
        <div class="naslov">Browse our offer</div>
    </div>

    <div class="bicikli">
        <div class="container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<h3>" . $row['naziv'] . "</h3>";
                    echo "<p>" . $row['opis'] . "</p>";
                    echo "<p class='price'>" . $row['cijena'] . " $</p>";
                    echo "<img src='" . $row['slika_link'] . "' alt='" . $row['naziv'] . "' class='img-fluid'>";
                    // Forma za slanje podataka na PHP skriptu
                    echo "<form action='handle_cart.php' method='POST'>";
                    // Skrivene polja za slanje podataka
                    echo "<input type='hidden' name='naziv' value='" . $row['naziv'] . "'>";
                    echo "<input type='hidden' name='cijena' value='" . $row['cijena'] . "'>";
                    echo "<input type='hidden' name='slika_link' value='" . $row['slika_link'] . "'>"; 
                    // Gumb za slanje forme
                    echo "<div class='gumbi'><input type='submit' value='Add to Cart'></div>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "No products available";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
