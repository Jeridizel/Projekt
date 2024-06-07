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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Admin Console</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="./Table 05_files/css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./Table 05_files/font-awesome.min.css">
    <link rel="stylesheet" href="./Table 05_files/style.css">
</head>

<body data-new-gr-c-s-check-loaded="14.1173.0" data-gr-ext-installed="">
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
            echo '<input class="admin" type="button" value="Admin" onclick="window.location.href = \'admin.php\';">';
        }
        ?>
    </header>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Admin Console</h2>
                    <h3 class="heading-section">Users</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table table-responsive-xl">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <?php
                                if ($result_users->num_rows > 0) {
                                    while ($row = $result_users->fetch_assoc()) {
                                        echo "<tr class='alert' role='alert'>";
                                        echo "<td>";
                                        echo "</label>";
                                        echo "</td>";
                                        echo "<td class='d-flex align-items-center'>";
                                        echo "<div class='pl-3 email'>";
                                        echo "<span>" . $row['Email'] . "</span>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td>" . $row['Username'] . "</td>";
                                        if ($row['Admin'] == 1) {
                                          echo "<td class='status' onclick='submitForm(" . $row['id'] . ", \"" . ($row['Admin'] == 1 ? 'remove_admin' : 'make_admin') . "\")'><span class='active'>Admin</span></td>";
                                          echo "<script>";
                                          echo "function submitForm(userId, action) {";
                                          echo "    var form = document.createElement('form');";
                                          echo "    form.setAttribute('method', 'post');";
                                          echo "    form.setAttribute('action', 'update_admin.php');";
                                          echo "    var hiddenUserId = document.createElement('input');";
                                          echo "    hiddenUserId.setAttribute('type', 'hidden');";
                                          echo "    hiddenUserId.setAttribute('name', 'user_id');";
                                          echo "    hiddenUserId.setAttribute('value', userId);";
                                          echo "    form.appendChild(hiddenUserId);";
                                          echo "    var hiddenAction = document.createElement('input');";
                                          echo "    hiddenAction.setAttribute('type', 'hidden');";
                                          echo "    hiddenAction.setAttribute('name', action);";
                                          echo "    form.appendChild(hiddenAction);";
                                          echo "    document.body.appendChild(form);";
                                          echo "    form.submit();";
                                          echo "}";
                                          echo "</script>";


                                      } else {
                                        echo "<td class='status' onclick='submitForm(" . $row['id'] . ", \"" . ($row['Admin'] == 1 ? 'remove_admin' : 'make_admin') . "\")'>";
                                        echo "<form id='adminForm_" . $row['id'] . "' action='update_admin.php' method='POST'>";
                                        echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>";
                                        echo "<span class='waiting'>Basic User</span>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "<script>";
                                        echo "function submitForm(userId, action) {";
                                        echo "    var form = document.getElementById('adminForm_' + userId);";
                                        echo "    var hiddenAction = document.createElement('input');";
                                        echo "    hiddenAction.setAttribute('type', 'hidden');";
                                        echo "    hiddenAction.setAttribute('name', action);";
                                        echo "    form.appendChild(hiddenAction);";
                                        echo "    form.submit();";
                                        echo "}";
                                        echo "</script>";
                                      }      
                                        echo "<td>";
                                        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                                        echo "<span aria-hidden='true'><i class='fa fa-close'>Remove user</i></span>";
                                        echo "</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No users found</td></tr>";
                                }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h3 class="heading-section">News</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <form action="updateNews.php" method="POST">
                        <table class="table table-responsive-xl">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result_news->num_rows > 0) {
                                    while ($row = $result_news->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td><textarea name='title[]'>" . $row['naslov'] . "</textarea></td>";
                                        echo "<td><textarea name='description[]'>" . $row['opis'] . "</textarea></td>";
                                        echo "<td>";
                                        echo "<input type='hidden' name='news_id[]' value='" . $row['id'] . "'>";
                                        echo "<button class='button-30' type='submit' name='update_admin'>Update</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No news found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

    <script src="./Table 05_files/jquery.min.js.preuzmi"></script>
    <script src="./Table 05_files/popper.js.preuzmi"></script>
    <script src="./Table 05_files/bootstrap.min.js.preuzmi"></script>
    <script src="./Table 05_files/main.js.preuzmi"></script>
    <script defer="" src="./Table 05_files/vedd3670a3b1c4e178fdfb0cc912d969e1713874337387"
        integrity="sha512-EzCudv2gYygrCcVhu65FkAxclf3mYM6BCwiGUm6BEuLzSb5ulVhgokzCZED7yMIkzYVg65mxfIBNdNra5ZFNyQ=="
        data-cf-beacon="{&quot;rayId&quot;:&quot;8863fd98b9b95d40&quot;,&quot;version&quot;:&quot;2024.4.1&quot;,&quot;token&quot;:&quot;cd0b4b3a733644fc843ef0b185f98241&quot;}"
        crossorigin="anonymous"></script>

</body>
<grammarly-desktop-integration data-grammarly-shadow-root="true"><template shadowrootmode="open">
        <style>
        div.grammarly-desktop-integration {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        div.grammarly-desktop-integration:before {
            content: attr(data-content);
        }
        </style>
        <div aria-label="grammarly-integration" role="group" tabindex="-1" class="grammarly-desktop-integration"
            data-content="{&quot;mode&quot;:&quot;full&quot;,&quot;isActive&quot;:true,&quot;isUserDisabled&quot;:false}">
        </div>
    </template></grammarly-desktop-integration>

</html>