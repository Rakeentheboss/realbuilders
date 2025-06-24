<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Database connection
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "realbuilders";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user-specific data from their table
$sql = "SELECT * FROM property WHERE username = '$username' AND Type='Rent'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Real Builders</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #d8d8d8, #ffffff);
            color: #333;
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

        header nav a, header .sign-in {
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

        header nav a:hover, header .sign-in:hover {
            background: red;
            color: #fff;
            border-color: red;
        }

        .section {
            padding: 40px 50px;
            text-align: center;
        }

        .section h2 {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .card-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            width: 280px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            text-align: left;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
        }

        .card-content h3 {
            margin: 0;
            font-size: 18px;
            color: #555;
            font-weight: 500;
        }

        .card-content p {
            margin: 5px 0;
            color: #777;
        }

        .view-details {
            display: inline-block;
            padding: 10px 25px;
            border: 2px solid #333;
            border-radius: 25px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            color: #333;
            transition: background 0.3s, color 0.3s;
        }

        .view-details:hover {
            background: #333;
            color: #fff;
        }
       
        
    </style>
</head>
<body>
    <header>
        <div>
            <h1>REAL BUILDERS - Dashboard</h1>
        </div>
        
        <nav>
            <a href="mb.php">Home</a>
            <a href="buy.html">Buy</a>
            <a href="viewsell.php">Sell</a>
            <a href="yourproperties.php">View your properties</a>
            <a href="designers.html">Interior Design Solutions</a>
            <a href="about us.html">About Us</a>
        </nav>

        <div>
        <a href="signin.html" class="sign-in">Logout</a>
        </div>
    </header>
    

    <section class="section">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <a href="rent0.html">Rent a new property</a>
        <div class="card-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<img src="sell/' . htmlspecialchars($row['photo']) . '" alt="Property Image">';
                    echo '<div class="card-content">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>Location: ' . htmlspecialchars($row['location']) . '</p>';
                    echo '<p>Type: ' . htmlspecialchars($row['type']) . '</p>';
                    echo '<p>Price: ' . htmlspecialchars($row['price']) . '</p>';
                    echo '<p>Contact Info: ' . htmlspecialchars($row['contact_info']) . '</p>';
                    // Form for deletion
                    echo '<form action="delete.php" method="POST">';
                    echo '<input type="hidden" name="property_id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<button type="submit" class="view-details">Delete</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No properties found.</p>';
            }
            ?>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 REAL BUILDERS. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
