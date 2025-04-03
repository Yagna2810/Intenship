<?php
session_start();

$insert = false;
if(isset($_POST['total'])){
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
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];

    
    $sql =" INSERT INTO `order_information`( `order_name`, `unit_price`, `quantity`, `total`)  VALUES ('$name','$price','$qty','$total')";
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
    header("Location: complate.php");
}    
?>
