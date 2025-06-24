<?php
session_start();  // Start the session to access the logged-in user's username

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("You must be logged in to rent a property.");
}

$title = $_POST['title'];
$contact_info = $_POST['contact_info'];
$location = $_POST['location'];
$price = $_POST['price'];
$type = $_POST['type'];  

// Get the logged-in user's username
$username = $_SESSION['username'];

$servername = "localhost";
$dbusername = "root";
$password = "";
$dbname = "realbuilders";

$conn = new mysqli($servername, $dbusername, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Photo upload handling
$photo_name = $_FILES['photo']['name'];
$photo_temp_name = $_FILES['photo']['tmp_name'];
$ownership_documents_name = $_FILES['ownership_documents_path']['name'];
$ownership_documents_temp_name = $_FILES['ownership_documents_path']['tmp_name'];
$lease_agreement_name = $_FILES['lease_agreement_path']['name'];
$lease_agreement_temp_name = $_FILES['lease_agreement_path']['tmp_name'];

// Define the folder path
$photo_folder = 'sell/' . $photo_name;
$ownership_documents_folder = 'sell/' . $ownership_documents_name;
$lease_agreement_folder = 'sell/' . $lease_agreement_name;

// Move uploaded files to the folder
if (move_uploaded_file($photo_temp_name, $photo_folder) && 
    move_uploaded_file($ownership_documents_temp_name, $ownership_documents_folder) && 
    move_uploaded_file($lease_agreement_temp_name, $lease_agreement_folder)) {
    echo "Files uploaded successfully.<br>";
} else {
    echo "File upload failed.<br>";
    $conn->close();
    exit(); // Stop execution if file upload failed
}

// Insert property data into the database, including the username
$sql = "INSERT INTO property (title, contact_info, location, price, photo, ownership_documents_path, lease_agreement_path, username,type) 
        VALUES ('$title', '$contact_info', '$location', '$price', '$photo_name', '$ownership_documents_name', '$lease_agreement_name', '$username','$type')";

if ($conn->query($sql) === TRUE) {
    // Redirect to viewsell.php after successful insertion
    header("Location: viewrent.php");
    exit(); // Ensure no further code is executed
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
