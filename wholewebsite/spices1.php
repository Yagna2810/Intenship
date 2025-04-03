<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM items");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Spices Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="spices.css">
    <link rel="stylesheet" href="common.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <style>
      .change:hover{
    color: black;
}
      
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
          <button class="dropbtn" style="color: red;">Buy Spices</button>
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
        <div id="content">
            <ul>
                <li>As the phrase goes, "variety is the spice of life." And basic spices in Indian cooking are extremely necessary for bringing out the greatest tastes in every dish.</li>
                <li>Spices are both what draws people to Indian food and what scares them off. When you find a recipe with 20 components, you may opt to turn the page and create a simpler recipe. Variety is essential in Indian cooking, but don't overload yourself by buying 30 spices; instead, start with the most basic Indian spices.</li>
                <li>We cannot imagine an Indian kitchen without our basic spices. These basic masalas for cooking are used in almost all Indian recipes; they are a staple. And so, if you enjoy Indian cuisine and would like to try your hand at it, we would suggest starting with these basic spices.</li>
                <li>These basic spices for Indian cooking include Turmeric Powder, CORIANDER POWDER, Garam Masala, Coriander Powder, Cumin Powder, etc.</li>
            </ul>
        </div>
        <div class="masala-container">
            <div class="masala-item">
                <img class="size" src="vasant_turmeric_powder.jpg" alt="vasant_turmeric_powder">
                <p id="name">TUMERIC POWDER</p>
                <p id="price">100 GM - ₹40</p>
                <a href="turmeric1.html" id="View" class="change">View More</a>
            </div>
            <div class="masala-item">
                <img class="size" src="vasant_chilli_powder.jpg" alt="vasant_chilli_powder">
                <p id="name">RED CHILLI POWDER</p>
                <p id="price">100 GM - ₹60</p>
                <a href="chilli1.html" id="View" class="change">View More</a>
            </div>
            <div class="masala-item">
                <img class="size" src="garam.png" alt="vasant_garam_masala_powder">
                <p id="name">GARAM MASALA</p>
                <p id="price">100 GM - ₹80</p>
                <a href="garam1.html" id="View" class="change">View More</a>
            </div>
            <div class="masala-item">
                <img class="size" src="vasant-coriander-cumin-powder.jpg" alt="vasant-coriander-cumin-powder">
                <p id="name">CORIANDER CUMIN POWDER</p>
                <p id="price">100 GM - ₹40</p>
                <a href="cc1.html" id="View" class="change">View More</a>
            </div>

            <div class="masala-item">
                <img class="size" src="vasant-coriander-powder.jpg" alt="vasant-coriander-powder">
                <p id="name">CORIANDER POWDER</p>
                <p id="price">100 GM - ₹35</p>
                <a href="coriander1.html" id="View" class="change">View More</a>
            </div>
            <div class="masala-item">
                <img class="size" src="vasant-kumthi-kashmiri-chilli-poweder_1.jpg" alt="vasant-kumthi-kashmiri-chilli-poweder_1">
                <p id="name">KUMTHI KASHMIRI CHILLI POWDER</p>
                <p id="price">100 GM - ₹140</p>
                <a href="kashmiri1.html" id="View" class="change">View More</a>
            </div>
            <div class="masala-item">
                <img class="size" src="vasant-achar-masala_1.jpg" alt="vasant-achar-masala_1">
                <p id="name">ACHAR POWDER</p>
                <p id="price">100 GM - ₹140</p>
                <a href="achar1.html" id="View" class="change">View More</a>
            </div>
    
          
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="masala-item">
            <img class="size" src="uploads/<?= $row['image1'] ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                <p id="name"><?= $row['name'] ?></p>
                <p id="price">100 GM - ₹<?= $row['price'] ?></p>
                <a id="View" class="change" href="<?= $row['slug'] ?>.html">View More</a>
            </div>
        <?php } ?>
    </div>
          <script src="index.js"></script>
    
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