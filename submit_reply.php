<?php
$host = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$database = "realbuilders";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment_id'], $_POST['username'], $_POST['reply'])) {
    $comment_id = intval($_POST['comment_id']);
    $username = $conn->real_escape_string($_POST['username']);
    $reply = $conn->real_escape_string($_POST['reply']);

    $stmt = $conn->prepare("INSERT INTO replies (comment_id, username, reply) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $comment_id, $username, $reply);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }

    $stmt->close();
}

$conn->close();
?>
