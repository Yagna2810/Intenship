<?php
session_start();

$insert = false;
if(isset($_POST['address'])){
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
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $country = $_POST['country'];
    $mobile = $_POST['mobile'];
    $whatsapp = $_POST['whatsapp'];
    
    $sql =" INSERT INTO `billing_information`(`first_name`, `middle_name`, `last_name`, `company`, `email`, `address`, `state`, `city`, `zipcode`, `country`, `mobile`, `whatsapp`) VALUES ('$fname','$mname','$lname','$company','$email','$address','$state','$city','$zipcode','$country','$mobile','$whatsapp')";
    // echo $sql; 

    // Execute the query
    if($con->query($sql) == true){

        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['email'] = $email;
        // echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
    header("Location: payment.php");
}    
?>
