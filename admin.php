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

$sql_users = "SELECT * FROM users";
$result_users = $conn->query($sql_users);

$sql_news = "SELECT * FROM novosti";
$result_news = $conn->query($sql_news);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Console</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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
            echo '<input class="admin" type="button" value="Admin" onclick="window.location.href = \'admin.php\';">';
        }
        ?>
    </header>
    <h2>Admin Console</h2>
    <h3>Users</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result_users->num_rows > 0) {
            while ($row = $result_users->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['Username'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . ($row['Admin'] == 1 ? 'Yes' : 'No') . "</td>";
                echo "<td><form action='update_admin.php' method='POST'>";
                echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>";
                echo "<button class='button-30' type='submit' name='make_admin'>Make Admin</button>";
                echo "<button class='button-30' type='submit' name='remove_admin'>Remove Admin</button>";
                echo "</form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }
        ?>
    </table>
    <h3>News</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result_news->num_rows > 0) {
            while ($row = $result_news->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td><textarea name='new_title'>" . $row['naslov'] . "</textarea></td>";
                echo "<td><textarea name='new_description'>" . $row['opis'] . "</textarea></td>";
                echo "<td>";
                echo "<form action='update_news.php' method='POST'>";
                echo "<input type='hidden' name='news_id' value='" . $row['id'] . "'>";
                echo "<button class='button-30' type='submit' name='update_news'>Update</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No news found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
