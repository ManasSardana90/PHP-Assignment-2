<?php
session_start();
include 'database_config.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verifying the password using the hash stored in the database
        if(password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            // Redirect to success page upon successful login
            header('Location: login_success.html');
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Username not found.";
    }
}
?>
