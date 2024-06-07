<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $database = "projekt_php";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Provjeri postoji li news_id u POST zahtjevu
    if(isset($_POST['news_id'])) {
        $news_ids = $_POST['news_id'];
        $titles = $_POST['title'];
        $descriptions = $_POST['description'];

        // Iteriraj kroz nizove news_id, naslov i opis
        foreach($news_ids as $key => $news_id) {
            $new_title = $conn->real_escape_string($titles[$key]); // Pristupamo naslovu svake vijesti
            $new_description = $conn->real_escape_string($descriptions[$key]); // Pristupamo opisu svake vijesti

            // Pripremi SQL upit
            $sql = "UPDATE novosti SET naslov = '$new_title', opis = '$new_description' WHERE id = $news_id";

            // Izvrši SQL upit
            if ($conn->query($sql) !== TRUE) {
                echo "Error updating record: " . $conn->error;
            }
        }

        // Preusmjeri korisnika na stranicu nakon ažuriranja
        header("Location: Table05.php");
        exit();
    } else {
        echo "News ID nije poslan.";
    }

    $conn->close();
}
?>
