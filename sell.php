<?php
session_start();  // Start the session to access the logged-in user's username

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("You must be logged in to sell a property.");
}

$title = $_POST['title'];
$contact_info = $_POST['contact_info'];
$location = $_POST['location'];
$price = $_POST['price'];
$type = $_POST['type']; 
$description = $_POST['description'];  
 
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
$photo_name1 = $_FILES['photo1']['name'];
$photo_name2 = $_FILES['photo2']['name'];
$photo_name3 = $_FILES['photo3']['name'];
$photo_name4 = $_FILES['photo4']['name'];
$photo_name5 = $_FILES['photo5']['name'];

$photo_temp_name = $_FILES['photo']['tmp_name'];
$photo_temp_name1 = $_FILES['photo1']['tmp_name'];
$photo_temp_name2 = $_FILES['photo2']['tmp_name'];
$photo_temp_name3 = $_FILES['photo3']['tmp_name'];
$photo_temp_name4 = $_FILES['photo4']['tmp_name'];
$photo_temp_name5 = $_FILES['photo5']['tmp_name'];

$ownership_documents_name = $_FILES['ownership_documents_path']['name'];
$ownership_documents_temp_name = $_FILES['ownership_documents_path']['tmp_name'];
$lease_agreement_name = $_FILES['lease_agreement_path']['name'];
$lease_agreement_temp_name = $_FILES['lease_agreement_path']['tmp_name'];

// Define the folder path for each file
$photo_folder = 'sell/' . $photo_name;
$photo_folder1 = 'sell/' . $photo_name1;
$photo_folder2 = 'sell/' . $photo_name2;
$photo_folder3 = 'sell/' . $photo_name3;
$photo_folder4 = 'sell/' . $photo_name4;
$photo_folder5 = 'sell/' . $photo_name5;
$ownership_documents_folder = 'sell/' . $ownership_documents_name;
$lease_agreement_folder = 'sell/' . $lease_agreement_name;

// Move uploaded files to the folder
if (move_uploaded_file($photo_temp_name, $photo_folder) && 
    move_uploaded_file($photo_temp_name1, $photo_folder1) && 
    move_uploaded_file($photo_temp_name2, $photo_folder2) && 
    move_uploaded_file($photo_temp_name3, $photo_folder3) && 
    move_uploaded_file($photo_temp_name4, $photo_folder4) &&
    move_uploaded_file($photo_temp_name5, $photo_folder5) &&
    move_uploaded_file($ownership_documents_temp_name, $ownership_documents_folder) && 
    move_uploaded_file($lease_agreement_temp_name, $lease_agreement_folder)) {
    echo "Files uploaded successfully.<br>";
} else {
    echo "File upload failed.<br>";
    $conn->close();
    exit(); // Stop execution if file upload failed
}

// Insert property data into the database, including the username
$sql = "INSERT INTO property (title, contact_info, location, price, photo, photo1, photo2, photo3, photo4, photo5, ownership_documents_path, lease_agreement_path, username, type, description) 
        VALUES ('$title', '$contact_info', '$location', '$price', '$photo_name', '$photo_name1', '$photo_name2', '$photo_name3', '$photo_name4', '$photo_name5', '$ownership_documents_name', '$lease_agreement_name', '$username', '$type', '$description')";

if ($conn->query($sql) === TRUE) {
    // Redirect to yourproperties.php after successful insertion
    header("Location: yourproperties.php");
    exit(); // Ensure no further code is executed
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
