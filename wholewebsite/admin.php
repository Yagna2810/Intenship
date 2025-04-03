<?php
session_start();
include 'db.php';
// if (isset($_SESSION["email"])) {
  $query = "SELECT * FROM users WHERE email = ?";
  $query1 = "SELECT * FROM order_information WHERE email = ?";
  $query2 = "SELECT * FROM billing_information WHERE email = ?";

  $stmt = mysqli_prepare($conn, $query);
  $stmt1 = mysqli_prepare($conn, $query1);
  $stmt2 = mysqli_prepare($conn, $query2);
  
  // Bind the parameter
  mysqli_stmt_bind_param($stmt, "s", $_SESSION["email"]);
  mysqli_stmt_bind_param($stmt1, "s", $_SESSION["email"]);
  mysqli_stmt_bind_param($stmt2, "s", $_SESSION["email"]);

  // Execute the query
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  mysqli_stmt_execute($stmt1);
  $items = mysqli_stmt_get_result($stmt1);
  
  mysqli_stmt_execute($stmt2);
  
  // Get the result
  
 
  $add = mysqli_stmt_get_result($stmt2);
// }
// else {
//   die("Database query failed: " . mysqli_error($conn));
// }

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
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="admin.css">
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
    <main id="main">
        <div class="account-container">
            <div class="account-header">
                <h1>Welcome Back</h1>
                <p>Manage your account settings, orders, and preferences.</p>
            </div>
            
            <div class="account-info">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="info-box" id="user-info">
                    <h3>User Information</h3>
                    <p><strong>Name:</strong> <?= $row['first_name'] ?> <?= $row['last_name'] ?></p>
                    <p><strong>Email:</strong><?= $row['email'] ?></p>
                    <button class="btn-edit" id="butt1" id="edit-user" onclick="editInfo()">Edit</button>
                </div>
                <?php } ?>

                <div class="info-box" id="order-history">
                    <h3>Order History</h3>
                    <?php if (mysqli_num_rows($items) > 0) {
                      echo '<table id="table1">
                      <thead>
                          <tr>
                              <th>Order-ID</th>
                              <th>Date</th>
                              <th>Quantity</th>
                              <th>Total</th>
                          </tr>
                          </thead>';
                    while ($row = mysqli_fetch_assoc($items)) {
                      echo "<tbody>
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['Date_Time']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['total']}</td>
                        </tr>
                    </tbody>";
    }
    echo "</table>";
} else {
    echo '<p id="p1">No data found</p>';
}?>
                    <button id="butt1" class="btn-view-orders" id="view-orders" onclick="viewOrders()">View All
                        Orders</button>
                </div>

                <?php while ($row = mysqli_fetch_assoc($add)) { ?><div class="info-box" id="address-management">
                    <h3>Address Management</h3>
                    <p><strong>Shipping Address:</strong><br><?= $row['address'] ?>,<?= $row['city'] ?>,<?= $row['state'] ?>,<?= $row['country'] ?>-<?= $row['zipcode'] ?></p>
                    <button id="butt1" class="btn-edit" id="edit-address" onclick="editAddress()">Edit Address</button>
                </div>
                <?php } ?>

                <div class="info-box" id="account-settings">
                    <h3>Account Settings</h3><br>
                    <button id="butt1" class="btn-change-password" id="change-password"onclick="window.location.href='change.php'">Change Password</button><br><br>
                    <button id="butt1" class="btn-logout" id="logout" onclick="window.location.href='logout.php'">Logout</button>
                </div>
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