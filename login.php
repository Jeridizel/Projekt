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

    // Provjera je li korisnik pokušao prijavu ili registraciju
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        // Ako je korisnik pokušao registraciju
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Provjera postoji li već korisnik s unesenim emailom
        $sql_check_email = "SELECT * FROM users WHERE Email='$email'";
        $result_check_email = $conn->query($sql_check_email);

        if ($result_check_email->num_rows > 0) {
            echo "<p class='error'>Korisnik s navedenim emailom već postoji!</p>";
        } else {
            // Unos novog korisnika u bazu
            $sql_insert_user = "INSERT INTO users (Username, Email, Password) VALUES ('$username', '$email', '$password')";

            if ($conn->query($sql_insert_user) === TRUE) {
                // Ako je registracija uspješna, preusmjeri na index.php
                $_SESSION["Admin"] = $row["Admin"];
                header("Location: index.php");
                exit();
            } else {
                echo "<p class='error'>Error: " . $sql_insert_user . "<br>" . $conn->error . "</p>";
            }
        }
    } elseif (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
        // Ako je korisnik pokušao prijavu
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        // Provjera postoji li korisnik s unesenim emailom
        $sql_check_user = "SELECT * FROM users WHERE Email='$email'";
        $result_check_user = $conn->query($sql_check_user);

        if ($result_check_user->num_rows > 0) {
            // Provjera ispravnosti lozinke
            $row = $result_check_user->fetch_assoc();
            if (password_verify($password, $row["Password"])) {
                // Ako je lozinka ispravna, započni sesiju i preusmjeri na index.php
                $_SESSION["username"] = $row["Username"];
                $_SESSION["Admin"] = $row["Admin"];
                header("Location: index.php");
                exit();
            } else {
                echo "<p class='error'>Netočna lozinka!</p>";
            }
        } else {
            echo "<p class='error'>Korisnik s navedenim emailom ne postoji!</p>";
        }
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="username" placeholder="User name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <button type="submit">Sign up</button>
            </form>
        </div>        

		<div class="login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="loginEmail" placeholder="Email" required="">
                <input type="password" name="loginPassword" placeholder="Password" required="">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>