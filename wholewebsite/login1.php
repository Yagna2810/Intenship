<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['email']))
{
    header("location: admin.php");
    exit;
}
require_once "config.php";

$email = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['email'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter email + password";
    }
    else{
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT  email, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = $email;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt,$email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["email"] = $email;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: admin.php");
                            
                        }
                        else {
                          $err = "Invalid email or password.";
                      }
                        
                    }
                    else {
                      $err = "Invalid email or password.";
                  }

                }

    }
  }    
}
if (!empty($err)) {
  echo "<script>alert('$err');</script>";
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
                <h5>ALREADY REGISTRATED</h5>
                <hr>
                <p>If you have an account with us, please log in.</p>
                <p>* Required Fields</p>
                <form action="login1.php" method="post">
                    <div id="email"><label for="Email">E-mail Address*</label></div>
                    <input type="email"name="email" id="low" style="text-transform: lowercase;"required>
                   <div id="pass"> <label for="">Password*</label></div>
                    <input type="password"name="password" style="text-transform: none;"minlength="6" required>
                    <div id="forgot"><a href="forgot.php">Forgot Your Password</a></div>
                    <input type="submit" value="Login" id="login">
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
