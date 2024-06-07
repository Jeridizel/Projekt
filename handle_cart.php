<?php
session_start(); 

$servername = "localhost";
$username = "root"; 
$password = "";
$database = "projekt_php"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["naziv"]) && isset($_POST["slika_link"]) && isset($_POST["cijena"])) {
        
        $naziv = $_POST["naziv"];
        $slika_link = $_POST["slika_link"];
        $cijena = $_POST["cijena"];

        $sql = "INSERT INTO kosarica (naziv, slika_link, cijena) VALUES ('$naziv', '$slika_link', '$cijena')";

        
        if ($conn->query($sql) === TRUE) {
            
            $_SESSION['notification'] = "Item successfully added to cart.";
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid data sent.";
    }
}

$conn->close();
?>

