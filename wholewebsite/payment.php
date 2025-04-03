<?php
session_start();

$insert = false;
if(isset($_POST['payment'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password, "spice");

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    //  echo "Success connecting to the db";

    // Collect post variables
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $email = $_SESSION['email'];
    $payment = $_POST['payment'];

    if($payment=='online'){
        echo'<script>alert("Sorry,Online Payment is not available.Please Choose another way.")</script>';
        // header("Location: payment.html");

    }
    else{
    
    $sql =" INSERT INTO `order_information`( `first_name`, `last_name`, `email`, `payment`) VALUES ('$fname','$lname','$email','$payment')";
    // echo $sql; 

    // Execute the query
    if($con->query($sql) == true){

        // echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
    header("Location: review.html");
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
    <link rel="stylesheet" href="bill.css">
    <link rel="stylesheet" href="common.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <style>
        
    </style>
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
        <a href="login1.php"><i class="fa-regular fa-user"></i></a>
        <a href="cart.html" style="color: red;"><i class="fa-solid fa-bag-shopping"></i></a>
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
        <div id="main">
            <div id="bill">
                <!-- Progress bar with step names -->
                <div class="progress-bar">
                    <div class="progress-line" style="width: 34.33%;"></div>
                    <div class="progress-indicators">
                        <div class="step-indicator active">
                            <div class="step-name">1.Billing</div>
                            <i class="fa-regular fa-circle"></i>
                        </div>
                        <div class="step-indicator" style="background-color:red; color:white;">
                            <div class="step-name">2.Payment</div>
                            <i class="fa-regular fa-circle"></i>
                        </div>
                        <div class="step-indicator">
                            <div class="step-name">3.Review</div>
                            <i class="fa-regular fa-circle"></i>
                        </div>
                        <div class="step-indicator">
                            <div class="step-name">4.Complete</div>
                            <i class="fa-regular fa-circle"></i>
                        </div>
                    </div>
                </div>
                <hr id="pl">

                <div id="payment">
                    <h4 style="color: white;font-weight: bolder;background-color: rgba(255,0,0,0.9);padding: 10px 0px ;"><span style="padding: 5px 10px;margin: 7px;color: black;background-color: white;font-weight: 400;">2</span>payment</h4>
                    <form action="" method="post">
                        <input type="radio" name="payment" value="cod" id="cod"><label for="cod">Cash On Delivery</label><br><br>
                        <input type="radio" name="payment" value="online" id="online" onclick="online()"><label for="online">Online Payment</label><br><br><br>
                        <button  id="submit">Next</button>
                    </form>                    
                </div>
            </div>
            <div id="info">
                <h1>Your Checkout Progress</h1>
                <hr>
                <h4>Billing Address</h4>
                <p id="ba"></p>
                <h4>Shipping Address</h4>
                <p id="ba1"></p>
                <h4>Payment Method</h4>
                <p id="bp"></p>
            </div>
        </div>
        <script src="cart.js"></script>
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
