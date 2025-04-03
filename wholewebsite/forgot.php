<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer

session_start();
include 'db.php'; // Database connection

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    // Check if email exists
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        $token = bin2hex(random_bytes(20)); // Generate a secure token
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour")); // Token expires in 1 hour

        // Insert token into password_reset table
        $insert = "INSERT INTO password_reset (email, token, expiry) VALUES (?, ?, ?)";
        $stmt2 = mysqli_prepare($conn, $insert);
        mysqli_stmt_bind_param($stmt2, "sss", $email, $token, $expiry);
        mysqli_stmt_execute($stmt2);

        // Setup Gmail SMTP
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ramdevmasala13@gmail.com'; // Replace with your Gmail
            $mail->Password = 'cccm uoft sdus jgkg'; // Replace with your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Sender & Recipient
            $mail->setFrom('ramdevmasala13@gmail.com', 'Ramdev Masala');
            $mail->addAddress($email);

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = "Password Reset Request";
            $mail->Body = "Click <a href='http://localhost/RAMDEV/reset_password.php?token=$token'>here</a> to reset your password.";

            // Send the email
            if ($mail->send()) {
                $message = "✅ Reset link sent to your email!";
            } else {
                $message = "❌ Failed to send email!";
            }
        } catch (Exception $e) {
            $message = "❌ Error: {$mail->ErrorInfo}";
        }
    } else {
        $message = "❌ Email not found!";
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="login.css">
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
          <button class="search-icon" onclick="toggleSearch()"><i class="fa-solid fa-magnifying-glass"></i></button>
          <form id="search-form" class="hidden">
            <input type="text" name="search-query" id="search-query" placeholder="Search..." oninput="performSearch()">
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
          <script src="index.js"> </script>
            <h1 id="l1">Login Or Create An Account</h1>
         <div id="main">
            <div id="new">
                <h5>NEW HERE?</h5>
                <hr>
                <ul>
                <li>Registration is free and easy!</li><br>
                <li>Faster checkout</li>
                <li>Save multiple shipping addresses</li>
                <li>View and track orders and more</li>
            </ul>
            <a href="signup.html">Create an Account</a>
            </div>
            <div id="old">
                <h5>Forgot Password</h5>
                <hr>
                <p>Enter your email to receive a password reset link.</p>
                <?php if ($message) { echo "<p class='message'>$message</p>"; } ?>
                <form  method="post">
                    <div id="email"><label for="Email">E-mail Address*</label></div>
                    <input type="email"name="email" id="low" style="text-transform: lowercase;"required>
                    <input style="width:auto;" type="submit" value=">Send Reset Link" id="login">
                </form>
            </div>
        </div>
        <script src="login.js"></script>
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
        <a href="https://www.instagram.com/shree_vasudev_traders_17?igsh=OW1rbzd1MDN2YjM4&utm_source=qr" id="ficon"><i
            class="fa-brands fa-instagram"></i></a>
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
