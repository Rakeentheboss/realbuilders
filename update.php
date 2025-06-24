<?php
session_start();  // Start session to access the logged-in user's username

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("You must be logged in to sell a property.");
}

// Database connection
$servername = "localhost";
$dbusername = "root";
$password = "";
$dbname = "realbuilders";

$conn = new mysqli($servername, $dbusername, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$title = $_POST['title'];
$contact_info = $_POST['contact_info'];
$location = $_POST['location'];
$price = $_POST['price'];
$type = $_POST['type']; 
$description = $_POST['description'];  
$username = $_SESSION['username'];  // Get logged-in user's username

// Get property ID (if editing an existing property)
$id = isset($_POST['id']) ? $_POST['id'] : null;

// File upload function
function uploadFile($file, $folder) {
    if (!empty($file['name'])) {
        $file_name = basename($file['name']);
        $file_path = $folder . $file_name;

        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            return $file_name;
        }
    }
    return null;
}

// Upload images
$upload_folder = "sell/";
$photo_names = [];
for ($i = 0; $i <= 5; $i++) {
    $photo_field = $i === 0 ? "photo" : "photo$i";
    if (isset($_FILES[$photo_field])) {
        $photo_names[$i] = uploadFile($_FILES[$photo_field], $upload_folder);
    } else {
        $photo_names[$i] = null;  // Keep null if no file uploaded
    }
}

// Upload documents
$ownership_documents_name = uploadFile($_FILES['ownership_documents_path'], $upload_folder);
$lease_agreement_name = uploadFile($_FILES['lease_agreement_path'], $upload_folder);

// SQL Query - Insert or Update
if ($id === null) {
    // INSERT: New Property (Auto-Increment `id`)
    $sql = "INSERT INTO property (title, contact_info, location, price, photo, photo1, photo2, photo3, photo4, photo5, 
            ownership_documents_path, lease_agreement_path, username, type, description) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssssssss", 
        $title, $contact_info, $location, $price, 
        $photo_names[0], $photo_names[1], $photo_names[2], $photo_names[3], $photo_names[4], $photo_names[5], 
        $ownership_documents_name, $lease_agreement_name, $username, $type, $description
    );
} else {
    // UPDATE: Existing Property (Uses `id`)
    $sql = "UPDATE property SET 
            title = ?, contact_info = ?, location = ?, price = ?, 
            photo = ?, photo1 = ?, photo2 = ?, photo3 = ?, photo4 = ?, photo5 = ?, 
            ownership_documents_path = ?, lease_agreement_path = ?, 
            type = ?, description = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssssssi", 
        $title, $contact_info, $location, $price, 
        $photo_names[0], $photo_names[1], $photo_names[2], $photo_names[3], $photo_names[4], $photo_names[5], 
        $ownership_documents_name, $lease_agreement_name, 
        $type, $description, $id
    );
}

// Execute the query
if ($stmt->execute()) {
    header("Location: yourproperties.php");  // Redirect after success
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
