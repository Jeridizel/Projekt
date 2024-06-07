<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest News</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="news.css">
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
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Latest News</h3>
                <hr>
                <div class="news-list">
                    <?php
                    $servername = "localhost";
                    $username = "root"; 
                    $password = ""; 
                    $database = "projekt_php"; 

                    $conn = new mysqli($servername, $username, $password, $database);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT naslov, opis, slika_link FROM novosti";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="card mb-3">';
                            echo '<div class="row no-gutters">';
                            echo '<div class="col-md-4">';
                            echo '<img src="' . $row["slika_link"] . '" class="card-img" alt="' . $row["naslov"] . '">';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $row["naslov"] . '</h5>';
                            echo '<p class="card-text">' . $row["opis"] . '</p>';
                            echo '<a href="#" class="btn btn-primary">Read More</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p class='text-center'>No news available.</p>";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
