<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("location: welcome.php");
    exit;
}

require_once "config.php";

$username = $password = "";
$err = "";

// If request method is POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['username'])) || empty(trim($_POST['password']))) {
        $err = "Please enter username and password.";
    } else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }

    if (empty($err)) {
        $sql = "SELECT username, password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            // Check if username exists
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $db_username, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    // Verify password
                    if (password_verify($password, $hashed_password)) {
                        // Store user data in session
                        $_SESSION["username"] = $db_username;
                        $_SESSION["loggedin"] = true;

                        // Redirect to welcome page
                        header("location: index.html");
                        exit;
                    } else {
                        $err = "Invalid username or password.";
                    }
                }
            } else {
                $err = "Invalid username or password.";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

// Show alert message if there is an error
if (!empty($err)) {
    echo "<script>alert('$err');</script>";
}
?>