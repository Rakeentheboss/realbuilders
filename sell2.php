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

// Retrieve search parameters
$location = isset($_GET['location']) ? $_GET['location'] : '';
$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';

// Build the query
$sql = "SELECT * FROM property WHERE 1=1";
if (!empty($location)) {
    $sql .= " AND location LIKE '%$location%'";
}
if (!empty($min_price)) {
    $sql .= " AND price >= $min_price";
}
if (!empty($max_price)) {
    $sql .= " AND price <= $max_price";
}

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
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background: linear-gradient(to right, #c9c9c9, #e1e1e1);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
        }
        header nav a, .sign-in {
            text-decoration: none;
            color: #333;
            margin: 0 20px;
            font-size: 16px;
            font-weight: 500;
            padding: 10px 20px;
            border: 2px solid #ccc;
            border-radius: 25px;
            transition: background 0.3s, color 0.3s, border-color 0.3s;
        }
        header nav a:hover, .sign-in:hover {
            background: red;
            color: #fff;
            border-color: red;
        }
        .filter-container {
            text-align: center;
            margin: 20px;
            padding: 15px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        .filter-container input, .filter-container button {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .property-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
        }
        .property-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 15px;
            overflow: hidden;
            width: 300px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }
        .property-card:hover {
            transform: scale(1.05);
        }
        .property-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
        }
        .property-info {
            padding: 15px;
        }
        .property-info h2 {
            font-size: 18px;
            margin: 0;
            color: #333;
        }
        .property-info p {
            color: #555;
            font-size: 14px;
        }
        .view-more {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background: rgb(82, 85, 88);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .view-more:hover {
            background: rgb(85, 86, 88);
        }
    </style>
</head>
<body>
<header>
    <div>
        <h1>REAL BUILDERS</h1>
    </div>
    <nav>
        <a href="mb.php">Home</a>
        <a href="buy.html">FlexiDeal</a>
        <a href="viewsell.php">Sell</a>
        <a href="viewrent.php">Rent</a>
        <a href="designers.html">Interior Design Solutions</a>
        <a href="yourproperties.php">View your Properties</a>
        <a href="about us.html">About Us</a>
    </nav>
    <div>
        <a href="signin.html" class="sign-in">Logout</a>
    </div>
</header>

<div class="filter-container">
    <form method="GET" action="">
        <input type="text" name="location" placeholder="Enter Location" value="<?php echo htmlspecialchars($location); ?>">
        <input type="number" name="min_price" placeholder="Min Price" value="<?php echo htmlspecialchars($min_price); ?>">
        <input type="number" name="max_price" placeholder="Max Price" value="<?php echo htmlspecialchars($max_price); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<div class="property-container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="property-card">';
            echo '<a href="sell3.php?id=' . $row['id'] . '">';
            echo '<img src="sell/' . $row['photo'] . '" alt="Property Image">';
            echo '</a>';
            echo '<div class="property-info">';
            echo '<h2>' . $row['title'] . '</h2>';
            echo '<p>Location: ' . $row['location'] . '</p>';
            echo '<p>Price:$ ' . number_format($row['price'], 2) . '</p>';
            echo '<p>Contact Info: ' . $row['contact_info'] . '</p>';
            echo '<a class="view-more" href="sell3.php?id=' . $row['id'] . '">View More</a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p style='text-align:center; font-size:18px;'>No properties available.</p>";
    }
    ?>
</div>
</body>
</html>
