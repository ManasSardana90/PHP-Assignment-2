<?php
include 'database_config.php'; // Including the database configuration file
$error_message = "ERROR";

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        // Hash the password before storing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            header('Location: login.html');
        } else {
            if ($conn->errno == 1062) {  // Error code for Duplicate entry
                $error_message = "Username already exists!";
            } else {
                $error_message = "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}
?>
// Display error message if any
<?php if (!empty($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>
