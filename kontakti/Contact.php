<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Contact_css.css">
    <title>Contact</title>
</head>

<body>
    <header id="header">
        <div class="logo"><img src="./images/logo2.jpg"></div>
        <input class="naslovnica" type="button" value="Home" onclick="window.location.href = '../index.php';">
        <input class="kontakt" type="button" value="Contact" onclick="window.location.href = '../kontakti/Contact.html';">
        <input class="o_nama" type="button" value="News" onclick="window.location.href = '../news.php';">
        <input class="kosarica" type="image" src="https://t4.ftcdn.net/jpg/01/86/94/37/360_F_186943704_QJkLZaGKmymZuZLPLJrHDMUNpAwuHPjY.jpg" onclick="window.location.href = '../kosarica.php';">
        <input class="logout" type="button" value="Log Out" onclick="window.location.href = '../login.php';">
        <?php
        if(isset($_SESSION['Admin']) && $_SESSION['Admin'] == 1) {
            echo '<input class="admin" type="button" value="Admin" onclick="window.location.href = \'../Table05.php\';">';
        }
        ?>
    </header>

    <div class="opis">Contact us:</div>

    <div id="forma">
        <form action="/action_page.php">
            <label for="fname">First name:</label><br>
            <input class="ime" type="text" id="fname" name="fname"><br>

            <label for="lname">Last name:</label><br>
            <input class="ime" type="text" id="lname" name="lname"><br><br>

            <label for="lname">Subject:</label><br>
            <input class="ime" type="text" id="subject" name="subject"><br><br>

            <select class="region" name="region">
                <option selected="selected" value="na">Select your region:</option>
                <option value="na">NORTH AMERICA</option>
                <option value="sa">SOUTH AMERICA</option>
                <option value="eu">EU</option>
                <option value="as">ASIA</option>
                <option value="af">AFICA</option>
            </select></p>

            <br>
            <p>Select your gender:</p>
            <label>Male
                <input class="male" type="radio" name="gender" checked />
                <span></span>
            </label>
            <label>Female
                <input class="male" type="radio" name="gender" />
                <span></span>
            </label><br><br><br>

            <label for="lname">Your message (optional)</label><br>
            <input class="ime" type="text" id="message" name="message"><br><br>
            <label class="checkbox" >I agree to the terms<input type="checkbox" name="check"/></label></p>
            <input class="gumb" type="submit" value="Submit">
        </form>
    </div>

    <div class="slika">or <a href="mailto:dsadovic@tvz.hr"> EMAIL US </a></div>
    <div class="flex-container4">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423284.04409439623!2d-118.74137200529665!3d34.020608470313235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20Kalifornija%2C%20Sjedinjene%20Ameri%C4%8Dke%20Dr%C5%BEave!5e0!3m2!1shr!2shr!4v1685896946038!5m2!1shr!2shr"
            width="80%" height="400px" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

</body>

</html>
