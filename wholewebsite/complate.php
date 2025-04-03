<?php
session_start();
include 'db.php';

$query2 = "SELECT * FROM billing_information WHERE first_name = ? AND last_name = ? AND email = ?";

  $stmt2 = mysqli_prepare($conn, $query2);
  
  // Bind the parameter
  mysqli_stmt_bind_param($stmt2, "sss", $_SESSION['fname'], $_SESSION['lname'], $_SESSION['email']);

  // Execute the query
  mysqli_stmt_execute($stmt2);
  $add = mysqli_stmt_get_result($stmt2);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="bill.css">
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
        <script src="index.js"> </script>
        <div id="main">
            <div id="bill">
                <!-- Progress bar with step names -->
                <div class="progress-bar">
                    <div class="progress-line" style="width: 97.33%;"></div>
                    <div class="progress-indicators">
                        <div class="step-indicator active">
                            <div class="step-name">1.Billing</div>
                            <i class="fa-regular fa-circle"></i>
                        </div>
                        <div class="step-indicator">
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

                <div id="complete">
                    <h4><span>4</span>Order complete</h4>
                    <p style="text-align: center;margin: 15px;margin-bottom: 0%;">Thank you for your order!</p>
                    <p style="text-align: center;margin: 15px;margin-top: 0%;">we will be try to deliver your spices within a week.</p>
                    <table id="cart-table">
                        <thead>
                            <tr id="cart-header">
                                <th></th>
                                <th id="ProductName">Product Name</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cart-items"></tbody>
                    </table>
                    <div class="grand">
                        <p id="grand-total"></p>
                    </div>
                    <h4 style="margin-top: 10px;">Shipping address:</h4>
                    <?php while ($row = mysqli_fetch_assoc($add)) { ?>
                      <p><?= $row['first_name'] ?> <?= $row['last_name'] ?></p>
                      <p><?= $row['address'] ?>,<?= $row['city'] ?>,<?= $row['state'] ?>,<?= $row['country'] ?>-<?= $row['zipcode'] ?><br><?= $row['mobile'] ?></p><br>

                      <?php } ?>
                    <div id="sub">
                        <button onclick="goToHome()" id="submit">Countinue Shopping</button>
                    </div>
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