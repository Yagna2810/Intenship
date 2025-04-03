<?php
session_start();
include 'db.php';

$message = "";

if (!isset($_GET['token'])) {
    die("Invalid request!");
}

$token = $_GET['token'];

// Check if the token is valid and not expired
$query = "SELECT email FROM password_reset WHERE token = ? ";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Invalid or expired token!");
}

$email = $row['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $message = "❌ Passwords do not match!";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in users table
        $update_query = "UPDATE users SET password = ? WHERE email = ?";
        $stmt2 = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt2, "ss", $hashed_password, $email);
        mysqli_stmt_execute($stmt2);

        // Remove the used token
        $delete_query = "DELETE FROM password_reset WHERE email = ?";
        $stmt3 = mysqli_prepare($conn, $delete_query);
        mysqli_stmt_bind_param($stmt3, "s", $email);
        mysqli_stmt_execute($stmt3);

        $message = "✅ Password changed successfully! <a href='login1.php'>Login here</a>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="change.css">
    <link rel="stylesheet" href="common.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    

</head>

<body>
<header>
        <!-- NAVBAR -->
        <div id="nav">
            <a href="index.html" id="logo"><img src="logo 1.png" alt="logo" id="logo1"></a>
            <div id="main1">
                <a href="index.html">Home</a>
                <a href="about.html">About us</a>
                <div class="dropdown">
                    <button class="dropbtn">Buy Spices</button>
                    <div class="dropdown-content">
                        <a href="spices1.php">buy 100 gm spices</a>
                        <a href="spices.php">buy 500 gm spices</a>
                        <a href="offer.html">Combo Offers</a>
                    </div>
                </div>
                <a href="contact.php">Contact Us</a>
            </div>
            <div id="icon">
                <div class="search-container">
                    <button class="search-icon" onclick="toggleSearch()"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                    <form id="search-form" class="hidden">
                        <input type="text" name="search-query" id="search-query" placeholder="Search..."
                            oninput="performSearch()">
                        <div id="search-results" class="hidden"></div>
                    </form>
                </div>
                <a href="login1.php" style="color: red;"><i class="fa-regular fa-user"></i></a>
                <a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a>
                <div class="n1">
                    <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                    <div class="dropdown-content">
                        <a href="offer.html">Combo Offers</a>
                        <a href="contact.php">Contact Us</a>
                        <a
                            href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13571.356648808773!2d73.10256807469602!3d22.69238056973417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e384329fe43cd%3A0x4c8999ca5276044e!2sAPMC!5e0!3m2!1sen!2sin!4v1712580706763!5m2!1sen!2sin">Our
                            Location</a>
                    </div>
                </div>
            </div>
        </div>


    </header>

    <main>
    <div class="form-wrapper">
        <div class="form-container">
            <h2>Change Password</h2>
            <form method="POST">
                <input type="password" name="new_password" placeholder="New Password" style="text-transform: none;" minlength="6" required>
                <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
                <button id="butt1" type="submit">Update Password</button>
            </form>
            <?php if ($message) { echo "<p class='message'>$message</p>"; } ?>
        </div>
    </div>
</main>


    <footer>
        <div id="footer">
            <div class="f1">IMPORTANT LINK</div>
            <span>
                <a href="contact.php" id="ficon">contact us</a> |
                <a href="cpolicy.html" id="ficon">cancelation and return policy</a> |
                <a href="tpolicy.html" id="ficon">terms and condition</a> |
                <a href="spolicy.html" id="ficon">shiping policy</a>
            </span>
            <div class="f1">ADDRESS</div>
            <div>Ramdev Masala co., Market Yard, Anand-388001</div>
            <div class="f1">
                <a href="https://www.instagram.com/shree_vasudev_traders_17?igsh=OW1rbzd1MDN2YjM4&utm_source=qr"
                    id="ficon"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.facebook.com/shree.vasudev.traders?mibextid=AEUHqQ" id="ficon"><i
                        class="fa-brands fa-facebook"></i></a>
                <a href="http://www.twitter.com" id="ficon"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
        <div id="rights">
            @2024 Ramdev Masala co. all rights reserved
        </div>
    </footer>
</body>
</html>