<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$review_text = $_POST['review_text'];

// Database connection
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "realbuilders";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert the review into the database
$sql = "INSERT INTO website_reviews (username, review) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $review_text);

// Execute the statement
if ($stmt->execute()) {
    echo "Thank you for your feedback!";
    header("Location: index.php"); // Redirect to the homepage or another page
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
