<?php
// Start the session to store user data after login
session_start();

// Database connection
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password
$dbname = "realbuilders"; // Your database username

$conn = new mysqli($servername, $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
// Get the form data from the POST request
$username = $_POST['username'];
$password = $_POST['password'];  // Password will be checked against the hashed password in the database


// Check if username and password are provided
if (!empty($username) && !empty($password)) {
    // Prepare SQL query to check the username
    $stmt = $conn->prepare("SELECT * FROM register WHERE LOWER(username) = LOWER(?)");

    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $username = $user['username'];

        // Verify the password using password_verify() for security
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables for user data

            $_SESSION['username'] = $user['username'];


            // Send JSON response with success status and user username
            echo json_encode([
                'success' => true,

                'username' => $user['username'],

            ]);
        } else {
            // Invalid password
            echo json_encode(['success' => false, 'message' => 'Invalid password.']);
        }
    } else {
        // User not found
        echo json_encode(['success' => false, 'message' => 'No user found with that username address.']);
    }
} else {
    // Missing username or password
    echo json_encode(['success' => false, 'message' => 'Please enter both username and password.']);
}

// Close the connection
$conn->close();
?>