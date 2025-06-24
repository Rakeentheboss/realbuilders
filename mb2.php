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

// SQL query to get properties
$sql = "SELECT * FROM property LIMIT 6"; // Fetch only 6 properties (you can adjust this)
$result = $conn->query($sql);

// Check if there are properties
if ($result->num_rows > 0) {
    // Fetch each property and display as a card
    while($row = $result->fetch_assoc()) {
        $propertyTitle = $row['title'];
        $propertyPrice = $row['price'];
        $propertyLocation = $row['location'];
        $propertyImage = 'sell/' . $row['photo']; // Assuming the image is stored in the 'sell/' folder
        $propertyLink = "sell2.php?id=" . $row['id']; // Link to the property details page
        ?>
        
        <div class="card">
            <img src="<?php echo $propertyImage; ?>" alt="Property Image">
            <div class="card-content">
                <h3><?php echo $propertyTitle; ?></h3>
                <p>$<?php echo $propertyPrice; ?> - <?php echo $propertyLocation; ?></p>
                <!-- Corrected the link here -->
            </div>
        </div>
        
        <?php
    }
} else {
    echo "No properties found.";
}
$conn->close();
?>
