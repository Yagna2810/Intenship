<?php
$insert = false;
if(isset($_POST['name'])){
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
    // echo "Success connecting to the db";

    // Collect post variables
    $name = $_POST['name'];
    $enquiry = $_POST['enquiry'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $comment = $_POST['comment'];
    
    $sql = "INSERT INTO `contact` (`enqiry`, `name`, `email`, `telephone`, `comment`)VALUES ('$enquiry','$name','$email', '$telephone', '$comment')";
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
    header("location: index.html");
}    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="contact.css">
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
          <button class="dropbtn" >Buy Spices</button>
          <div class="dropdown-content">
            <a href="spices1.php">buy 100 gm spices</a>
            <a href="spices.php">buy 500 gm spices</a>
            <a href="offer.html">Combo Offers</a>
          </div>
        </div>
        <a href="contact.php" style="color: red;">Contact Us</a>
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
  <?php include 'bot.php'; ?>

    <main>
      <script src="index.js"> </script>
        <div id="cu">
            <p>Contact Us</p>
        </div>
        <div id="cu1">
            <h5>CONTACT INFORMATION</h5>
            <hr>
            <div id="main">
                <div id="form">
                    <form action="contact.php" method="POST">
                        <div><select name="enquiry" id="select">
                                <option value="">--Select Option--</option>
                                <option value="">Customer enquiry</option>
                                <option value="">Bulk enquiry</option>
                                <option value="">Other</option>
                            </select>
                        </div>
                        <div id="form">
                            <input type="text"name="name" placeholder="Name">
                        </div>
                        <div id="form">
                            <input type="email" name="email"placeholder="Email">
                        </div>
                        <div id="form">
                            <input type="text"name="telephone" placeholder="Telephone" minlength="10">
                        </div>
                        <div id="form">
                            <textarea name="comment" id="" cols="50" rows="7" name="comment"placeholder="Comment"></textarea>
                        </div>
                        <div>
                          <input type="submit" id="sum" value="Submit">

                        </div>
                    </form>
                </div>
                <div id="response"></div>
                <div id="vl"></div>
                <div id="map"><iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13571.356648808773!2d73.10256807469602!3d22.69238056973417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e384329fe43cd%3A0x4c8999ca5276044e!2sAPMC!5e0!3m2!1sen!2sin!4v1712580706763!5m2!1sen!2sin"
                        width="500" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
    </main>
    <footer>
      <div id="footer">
        <div class="f1">IMPORTANT LINK</div>
        <span>
          <a href="contact.php" id="ficon"style="color: black;">contact us</a>|
          <a href="cpolicy.html" id="ficon">cancelation and return policy</a>|
          <a href="tpolicy.html" id="ficon">terms and condition</a>|
          <a href="spolicy.html" id="ficon">shiping policy</a>
        </span>
        <div class="f1">ADDRESS</div>
        <div>Ramdev Masala co., Market Yard, Anand-388001</div>
        <div class="f1">
          <a href="https://www.instagram.com/shree_vasudev_traders_17?igsh=OW1rbzd1MDN2YjM4&utm_source=qr" id="ficon"><i class="fa-brands fa-instagram"></i></a>
          <a href="https://www.facebook.com/shree.vasudev.traders?mibextid=AEUHqQ" id="ficon"><i class="fa-brands fa-facebook"></i></a>
          <a href="http://www.twitter.com" id="ficon"><i class="fa-brands fa-twitter"></i></a>
        </div>
      </div>
      <div id="rights">
      @2024 Ramdev Masala co. all rights reserved
      </div>
    </footer>
</body>

</html>