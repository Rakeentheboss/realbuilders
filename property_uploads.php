<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$username = "root";
$password = "";
$database = "realbuilders";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Fetch total number of properties
$total_query = "SELECT COUNT(*) AS total_properties FROM property";
$total_result = $conn->query($total_query);

if (!$total_result) {
    die(json_encode(["error" => "Error fetching total properties: " . $conn->error]));
} else {
    $total_row = $total_result->fetch_assoc();
    $total_properties = $total_row['total_properties'];
}

// Fetch property details
$property_query = "SELECT id, title, contact_info, location, username FROM property";
$property_result = $conn->query($property_query);

$properties = [];

if ($property_result->num_rows > 0) {
    while ($row = $property_result->fetch_assoc()) {
        $properties[] = $row;
    }
}

// Close connection
$conn->close();

// Return JSON
header('Content-Type: application/json');
echo json_encode([
    "total_properties" => $total_properties,
    "properties" => $properties
]);
exit();
?>
