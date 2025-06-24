<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "realbuilders"; // Change this to your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count users
$user_query = "SELECT COUNT(*) as total_users FROM register";
$user_result = $conn->query($user_query);
$user_count = $user_result->fetch_assoc()['total_users'];

// Count properties
$property_query = "SELECT COUNT(*) as total_properties FROM property";
$property_result = $conn->query($property_query);
$property_count = $property_result->fetch_assoc()['total_properties'];

// Return JSON response
echo json_encode(["users" => $user_count, "properties" => $property_count]);

$conn->close();
?>
