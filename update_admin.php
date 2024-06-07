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

    $user_id = $_POST['user_id'];
    echo $user_id;

    if (isset($_POST['make_admin'])) {
        // Ako je pritisnut gumb "Make Admin"
        $sql = "UPDATE users SET Admin = 1 WHERE id = $user_id";
    } elseif (isset($_POST['remove_admin'])) {
        // Ako je pritisnut gumb "Remove Admin"
        $sql = "UPDATE users SET Admin = 0 WHERE id = $user_id";
    }

    if (!empty($sql)) { // Provjerite je li $sql definiran prije izvršavanja upita
        if ($conn->query($sql) === TRUE) {
            header("Location: Table05.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Error: SQL query is empty.";
    }

    $conn->close();
}
?>
