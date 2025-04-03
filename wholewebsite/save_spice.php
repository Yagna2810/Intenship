<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $price1 = mysqli_real_escape_string($conn, $_POST['price_1']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $how_to_use = mysqli_real_escape_string($conn, $_POST['how_to_use']);
    $about_spice1 = mysqli_real_escape_string($conn, $_POST['about_spice_1']);
    $about_spice2 = mysqli_real_escape_string($conn, $_POST['about_spice_2']);
    $about_spice3= mysqli_real_escape_string($conn, $_POST['about_spice_3']);
    $health_benefits = mysqli_real_escape_string($conn, $_POST['health_benefits']); // comma-separated

    $target_dir = "uploads/";

    $image1 = $_FILES['image_1']['name'];
    $image2 = $_FILES['image_2']['name'];

    $target_file1 = $target_dir . basename($image1);
    $target_file2 = $target_dir . basename($image2);

    move_uploaded_file($_FILES['image_1']['tmp_name'], $target_file1);
    move_uploaded_file($_FILES['image_2']['tmp_name'], $target_file2);

    // Generate SEO-friendly slug
    $slug = strtolower(str_replace(' ', '-', $name));
    $slug1 = strtolower(str_replace(' ', '-', $name)) . '1';


    // Insert into database
    $sql = "INSERT INTO items (name, price, price1, image1, image2, city, state, how_to_use, about_spice, health_benefits, slug , slug1) 
            VALUES ('$name', '$price', '$price1', '$image1', '$image2', '$city', '$state', '$how_to_use', 
                    '$about_spice1 $about_spice2 $about_spice3', '$health_benefits', '$slug' ,'$slug1')";

    
    if (mysqli_query($conn, $sql)) {
        // Convert health benefits into an HTML list
        $benefitsList = "";
        $benefits = explode(",", $health_benefits);
        foreach ($benefits as $benefit) {
            $benefitsList .= "<li>" . trim($benefit) . "</li>";
        }

        // Generate HTML Page for this product
        $htmlContent = <<<HTML
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vasant $name-500g</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="spice.css">
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
      <script src="index.js"> </script>
        <div id="back">
            <a href="spices.php">&laquo; back to shop page</a>
        </div>
        <!-- image gallary -->
        <!-- Thumbnail images -->
        <div class="Img">
            <div>
                <img class="subImg" src="uploads/$image1" alt="$name"><br>
                <img class="subImg" src="uploads/$image2" alt="$name">
            </div>
            <div>
                <img id="mainImg" src="uploads/$image1" alt="Main Image">
            </div>

            <script src="spice.js"></script>
            <div id="main">
            <h2>$name</h2>
         <div id="p1">
            <img src="veg.png" alt="veg">
            <p>This is a vegetarian product.</p>
        </div>
            <h4>Vasant $name</h4>
            <p id="p2">High-quality $name from $city, $state</p>
            <h5>$name Speciality</h5>
            <p id="p3">Made from procured from one of the finest $name producing cities of India and
                processed in
                neatly maintained hygienic conditions, Vasant $name is 100% pure. Moreover, it is rich in
                Curcumin
                which benefits your health in numerous ways.</p>
              <!-- Base Price (Hidden or Stored in Data Attribute) -->
      

              <!-- Base Price (Hidden or Stored in Data Attribute) -->
              <input type="hidden" id="baseprice" value="$price">

<!-- Display Total Price -->

<!-- Display Total Price -->
<h1>₹<span id="totalPrice">$price</span></h1>


            <div id="cart">
            <table>
                <tr>
                    <th>packed size</th>
                    <th>Qty</th>
                </tr>
                <tr>
                    <td>
                        <p>500 GM</p>
                    </td>
                    <td>
                        <input type="number" id="quantity" min="1" value="1" onchange="updatePrice()">
                    </td>
                </tr>
            </table>
            <button id="b1"onclick="addToCart('Vasant $name', $price, 'uploads/$image1')">add to cart</button>
        </div>
        </div>
        </div>
        <div id="use">
            <h5>how to use:</h5>
            <p>$how_to_use</p>
        </div>
        <div id="about">
            <h5>About the Spice:</h5>
            <p>$about_spice1</p><br>
            <p>$about_spice2</p><br>
            <p>$about_spice3</p>
        </div>
        <div id="health">
            <h5>Health Benefits of $name:</h5>
            <ul>
              $benefitsList
            </ul>
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
HTML;

        // Save HTML file
        file_put_contents("$slug.html", $htmlContent);      
  
  
  // Generate HTML Page for this product
  $htmlContent = <<<HTML
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>vasant $name-100g</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
  integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="spice.css">
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
<script src="index.js"> </script>
  <div id="back">
      <a href="spices1.php">&laquo; back to shop page</a>
  </div>
  <!-- image gallary -->
  <!-- Thumbnail images -->
  <div class="Img">
      <div>
          <img class="subImg" src="uploads/$image1" alt="$name"><br>
          <img class="subImg" src="uploads/$image2" alt="$name">
      </div>
      <div>
          <img id="mainImg" src="uploads/$image1" alt="Main Image">
      </div>

      <script src="spice.js"></script>
      <div id="main">
      <h2>$name</h2>
   <div id="p1">
      <img src="veg.png" alt="veg">
      <p>This is a vegetarian product.</p>
  </div>
      <h4>Vasant $name</h4>
      <p id="p2">High-quality $name from $city, $state</p>
      <h5>$name Speciality</h5>
      <p id="p3">Made from procured from one of the finest $name producing cities of India and
          processed in
          neatly maintained hygienic conditions, Vasant $name is 100% pure. Moreover, it is rich in
          Curcumin
          which benefits your health in numerous ways.</p>
        <!-- Base Price (Hidden or Stored in Data Attribute) -->
        <!-- Base Price (Hidden or Stored in Data Attribute) -->
        <input type="hidden" id="baseprice" value="$price1">

<!-- Display Total Price -->

<!-- Display Total Price -->
<h1>₹<span id="totalPrice">$price1</span></h1>


      <div id="cart">
      <table>
          <tr>
              <th>packed size</th>
              <th>Qty</th>
          </tr>
          <tr>
              <td>
                  <p>100 GM</p>
              </td>
              <td>
                  <input type="number" id="quantity" min="1" value="1" onchange="updatePrice()">
              </td>
          </tr>
      </table>
      <button id="b1"onclick="addToCart('Vasant $name', $price, 'uploads/$image1')">add to cart</button>
  </div>
  </div>
  </div>
  <div id="use">
      <h5>how to use:</h5>
      <p>$how_to_use</p>
  </div>
  <div id="about">
      <h5>About the Spice:</h5>
      <p>$about_spice1</p><br>
      <p>$about_spice2</p><br>
      <p>$about_spice3</p>
  </div>
  <div id="health">
      <h5>Health Benefits of $name:</h5>
      <ul>
        $benefitsList
      </ul>
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
HTML;

  // Save HTML file
  file_put_contents("$slug1.html", $htmlContent);
  

  echo "<script>alert('Item added successfully!');</script>";
  header("location: add_spice.php");       
}
else {
  echo "Error: " . mysqli_error($conn);
}
}


?>