<?php
// Database connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest review
$sql = "SELECT username, review, submitted_at FROM website_reviews ORDER BY submitted_at DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $review = $result->fetch_assoc();
    echo "<h3>Latest Review:</h3>";
    echo "<p><strong>" . htmlspecialchars($review['username']) . ":</strong> " . htmlspecialchars($review['review']) . "</p>";
    echo "<p><i>Submitted on: " . $review['submitted_at'] . "</i></p>";
} else {
    echo "<p>No reviews yet.</p>";
}

$conn->close();
?>
