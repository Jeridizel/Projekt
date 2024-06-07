<?php
session_start();

// Provjera postojanja košarice u sesiji
if (isset($_SESSION['cart'])) {
    // Brojanje stavki u košarici
    $itemCount = count($_SESSION['cart']);
    echo $itemCount;
} else {
    // Ako nema stavki u košarici, vraćamo 0
    echo "0";
}
?>
