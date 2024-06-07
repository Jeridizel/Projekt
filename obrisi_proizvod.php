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

if(isset($_POST['naziv'])) {
    $naziv = $_POST['naziv'];
    
    $sql = "DELETE FROM kosarica WHERE naziv = '$naziv'";
    if ($conn->query($sql) === TRUE) {
        echo "Proizvod uspješno izbrisan.";
        header("Location: kosarica.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
