<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "realbuilders";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the property ID is passed via POST
if (isset($_POST['property_id'])) {
    $property_id = $_POST['property_id'];

    // SQL query to delete the property by its ID
    $sql = "DELETE FROM property WHERE id = ?";
    
    // Prepare statement to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $property_id); // "i" means integer
        $stmt->execute();
        
        if ($stmt->execute()) {

            header("Location: delete.html");
            exit();  
        } else {
            echo "No property found with that ID.";
        }
        
        $stmt->close();
    } else {
        echo "Error preparing the statement.";
    }
} else {
    echo "No property ID provided.";
}

$conn->close();
?>
