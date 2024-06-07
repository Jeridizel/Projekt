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
$sql = "SELECT naziv, cijena, slika_link FROM kosarica";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="kosarica.css">
</head>

<body>
    <header id="header">
        <div class="logo"><img src="./images/logo2.jpg"></div>
        <input class="naslovnica" type="button" value="Home" onclick="window.location.href = 'index.php';">
        <input class="kontakt" type="button" value="Contact" onclick="window.location.href = 'kontakti/Contact.php';">
        <input class="o_nama" type="button" value="News" onclick="window.location.href = 'news.php';">
        <input class="kosarica" type="image"
            src="https://t4.ftcdn.net/jpg/01/86/94/37/360_F_186943704_QJkLZaGKmymZuZLPLJrHDMUNpAwuHPjY.jpg"
            onclick="window.location.href = 'kosarica.php';">
        <input class="logout" type="button" value="Log Out" onclick="window.location.href = 'login.php';">
        <?php
        if(isset($_SESSION['Admin']) && $_SESSION['Admin'] == 1) {
            echo '<input class="admin" type="button" value="Admin" onclick="window.location.href = \'./Table05.php\';">';
        }
        ?>
    </header>

    <section class="wrapper">
        <div class="top">Your cart</div>
        <div class="bottom" aria-hidden="true">Your cart</div>
    </section>
    <div class="cart">
        <?php
    if ($result->num_rows > 0) {
        ?>
        <table class="table">
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>IME PROIZVODA</td>
                    <td>CIJENA</td>
                    <td>SLIKA</td>
                    <td>DELETE</td>
                </tr>
                <?php
            $i = 1; // Početna vrijednost brojača
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["naziv"]; ?></td>
                    <td><?php echo $row["cijena"]; ?> $</td>
                    <td><img id="product-image" src="<?php echo $row["slika_link"]; ?>" width="50" height="50"></td>
                    <td>
                        <form method='post' action='obrisi_proizvod.php'>
                            <input type='hidden' name='naziv' value="<?php echo $row["naziv"]; ?>" />
                            <input type='hidden' name='action' value="delete" />
                            <button type="submit" class="button-57" role="button">
                                <span class="text">Delete Item</span>
                                <span>Delete Item</span>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php
                $i++; // Inkrementiranje brojača
            }
            ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "<h3>Nema dostupnih proizvoda!</h3>";
    }
    ?>
    </div>
</body>

</html>

<?php
$conn->close();
?>