<?php
session_start(); // Start session only once at the beginning

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "realbuilders";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM register WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password using password_verify
        if (password_verify($password, $row['password'])) {
            // Store the username in session for future use
            $_SESSION['username'] = $username;

            // Redirect to the user dashboard page (mb.php)
            header("Location: mb.php");
            exit(); // Stop further script execution
        } else {
            // Display a simple "Invalid username" message if password is incorrect
            echo "<script>alert('Invalid username or password.'); window.location.href='signin.html';</script>";
        }
    } else {
        // Display a simple "Invalid username" message if username doesn't exist
        echo "<script>alert('Invalid username or password.'); window.location.href='signin.html';</script>";
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
}
?>
