<?php
session_start();
include 'db.php'; // Include database connection

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    echo "User not logged in!";
    exit;
}

$message = ""; // Message to display after form submission

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the stored password
    $query = "SELECT password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row || !password_verify($current_password, $row['password'])) {
        $message = "❌ Current password is incorrect!";
    } elseif ($new_password !== $confirm_password) {
        $message = "❌ New passwords do not match!";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in database
        $update_query = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $message = "✅ Password changed successfully!";
        } else {
            $message = "❌ Error updating password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional CSS -->
    <style>
        /* Basic Modal Styling */
        .modal {
            display: flex;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 350px;
            text-align: center;
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
            width: 100%;
        }

        button {
            padding: 10px;
            background: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .message {
            margin-top: 10px;
            color: red;
        }
    </style>
</head>

<body>

    <!-- Button to Open Modal -->
    <button id="change-password-btn">Change Password</button>

    <!-- Password Change Modal -->
    <div id="password-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Change Password</h2>
            <form method="POST">
                <input type="password" name="current_password" placeholder="Current Password" required>
                <input type="password" name="new_password" placeholder="New Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
                <button type="submit">Update Password</button>
            </form>
            <?php if ($message) { echo "<p class='message'>$message</p>"; } ?>
        </div>
    </div>

    <script>
        // Handle modal popup
        document.getElementById("change-password-btn").addEventListener("click", function() {
            document.getElementById("password-modal").style.display = "flex";
        });

        document.querySelector(".close").addEventListener("click", function() {
            document.getElementById("password-modal").style.display = "none";
        });
    </script>

</body>

</html>
