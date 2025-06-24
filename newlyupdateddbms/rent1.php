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

// Retrieve property data from the database
$sql = "SELECT * FROM property where type='Rent'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Properties | Real Builders</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            background-color: rgb(100, 102, 104);
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 36px;
            margin: 0;
        }

        .property-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            padding: 30px 20px;
        }

        .property-card {
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .property-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .property-card img:hover {
            transform: scale(1.1);
        }

        .property-info {
            padding: 20px;
            text-align: center;
        }

        .property-info h3 {
            margin: 0;
            font-size: 22px;
            color: #333;
        }

        .property-info p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        .price {
            font-size: 18px;
            color: #28a745;
            font-weight: bold;
        }

        .contact-info {
            font-size: 14px;
            color: #888;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Available properties for Rent</h1>
</header>
<div class="button-container">
    <a href="rent0.html" class="rent-button">Give a Property for Rent</a>
</div>

<style>
    .button-container {
        display: flex;
        justify-content: center; /* Centers horizontally */
        align-items: center; /* Centers vertically */
        margin: 20px 0; /* Adds spacing above and below */
    }
</style>


<div class="property-container">
    <?php
    // Display the properties from the database
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="property-card">';
            echo '<img src="sell/' . $row['photo'] . '" alt="Property Image">'; // Correctly reference the column for photo
            echo '<p><strong>Ownership Document:</strong><a href="sell/' . $row['ownership_documents_path'] . '" target="_blank">View Document</a></p>'; // Link to ownership document
            echo '<p><strong>Lease Agreement:</strong><a href="sell/' . $row['lease_agreement_path'] . '" target="_blank">View Lease</a></p>'; // Link to lease agreement
            echo '<div class="property-info">';
            echo '<h3>' . $row['title'] . '</h3>';
            echo '<p>' . $row['location'] . '</p>';
            echo '<p class="price">Price: $' . number_format($row['price'], 2) . '</p>';
            echo '<p class="contact-info">Contact: ' . $row['contact_info'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p style='text-align:center;width:100%;font-size:18px;color:#555;'>No properties found</p>";
    }
    ?>
</div>

<footer>
    <p>&copy; 2024 Real Builders. All rights reserved.</p>
</footer>

<?php
// Close the database connection
$conn->close();
?>

</body>
</html>
