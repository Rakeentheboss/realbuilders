<?php
session_start();  // Start the session to access the logged-in user's data

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

// Create connection
$conn = new mysqli($servername, $dbusername, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from username
$user_query = $conn->prepare("SELECT id FROM users WHERE username = ?");
$user_query->bind_param("s", $username);
$user_query->execute();
$user_result = $user_query->get_result();

if ($user_result->num_rows == 0) {
    die("User not found.");
}

$user_data = $user_result->fetch_assoc();
$user_id = $user_data['id'];
$user_query->close();

// Start transaction to maintain data consistency
$conn->begin_transaction();

try {
    // Insert property details into properties table
    $property_stmt = $conn->prepare("INSERT INTO properties (user_id, title, contact_info, location, price, type, description, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $property_stmt->bind_param("isssdss", $user_id, $title, $contact_info, $location, $price, $type, $description);
    $property_stmt->execute();
    
    // Get the last inserted property ID
    $property_id = $conn->insert_id;
    $property_stmt->close();

    // Function to upload files
    function uploadFile($file, $folder) {
        $file_name = basename($file['name']);
        $file_path = $folder . $file_name;

        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            return $file_name; // Return the stored file name
        } else {
            return false; // Return false if upload failed
        }
    }

    // Upload images
    $upload_folder = "sell/";
    $image_files = ['photo', 'photo1', 'photo2'];

    foreach ($image_files as $image) {
        if (!empty($_FILES[$image]['name'])) {
            $uploaded_image = uploadFile($_FILES[$image], $upload_folder);
            if ($uploaded_image) {
                // Insert into property_images table
                $img_stmt = $conn->prepare("INSERT INTO property_images (property_id, image_path, uploaded_at) VALUES (?, ?, NOW())");
                $img_stmt->bind_param("is", $property_id, $uploaded_image);
                $img_stmt->execute();
                $img_stmt->close();
            } else {
                throw new Exception("Error uploading images.");
            }
        }
    }

    // Upload documents
    $document_files = ['ownership_documents_path' => 'Ownership', 'lease_agreement_path' => 'Lease Agreement'];

    foreach ($document_files as $doc_key => $doc_type) {
        if (!empty($_FILES[$doc_key]['name'])) {
            $uploaded_document = uploadFile($_FILES[$doc_key], $upload_folder);
            if ($uploaded_document) {
                // Insert into property_documents table
                $doc_stmt = $conn->prepare("INSERT INTO property_documents (property_id, document_type, document_path, uploaded_at) VALUES (?, ?, ?, NOW())");
                $doc_stmt->bind_param("iss", $property_id, $doc_type, $uploaded_document);
                $doc_stmt->execute();
                $doc_stmt->close();
            } else {
                throw new Exception("Error uploading documents.");
            }
        }
    }

    // Commit transaction if everything succeeds
    $conn->commit();
    
    // Redirect after success
    header("Location: yourproperties.php");
    exit();
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    die("Error: " . $e->getMessage());
}

// Close connection
$conn->close();
?>
