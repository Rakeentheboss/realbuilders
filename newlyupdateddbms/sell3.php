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

// Ensure 'id' is received via GET method
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Retrieve property data using a prepared statement
    $stmt = $conn->prepare("SELECT * FROM property WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details | Real Builders</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f9f9f9;
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

header nav a {
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

header nav a:hover {
    background: red;
    color: #fff;
    border-color: red;
}

.sign-in {
    text-decoration: none;
    color: #333;
    font-size: 16px;
    font-weight: 500;
    padding: 10px 20px;
    border: 2px solid #ccc;
    border-radius: 25px;
    transition: background 0.3s, color 0.3s, border-color 0.3s;
}

.sign-in:hover {
    background: red;
    color: #fff;
    border-color: red;
}

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        .property-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .image-box {
            text-align: center;
        }

        .image-box img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(114, 109, 109, 0.1);
            margin-bottom: 10px;
        }

        .property-summary {
            padding: 10px;
            max-height: 250px;
            overflow: hidden;
            background-color: white;
            text-align: center;
        }

        .property-summary h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .property-summary .property-details p {
            margin: 8px 0;
        }

        .property-summary .price {
            color: #27ae60;
            font-size: 20px;
            font-weight: bold;
        }

        .property-description {
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .property-description h2 {
            font-size: 20px;
            color: #333;
        }

        .property-description p {
            color: #555;
            font-size: 16px;
        }

        footer {
            background-color: rgb(86, 88, 90);
            color: white;
            padding: 30px 50px;
            text-align: center;
            margin-top: 50px;
        }

        footer h3 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        footer p {
            font-size: 14px;
        }

        footer a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .property-layout {
                grid-template-columns: 1fr;
            }

            header {
                flex-direction: column;
                align-items: center;
            }

            header nav a {
                margin: 5px;
            }
        }

        .sign-in {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        .sign-in:hover {
            background-color: #e74c3c;
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
            <a href="buy.html">Buy</a>
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

    <div class="container">
        <?php
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
            <div class="property-layout">
                <div class="image-box">
                    <img src="sell/<?php echo htmlspecialchars($row['photo']); ?>" alt="Property Image">
                    <img src="sell/<?php echo htmlspecialchars($row['photo1']); ?>" alt="Property Image 1">
                    <img src="sell/<?php echo htmlspecialchars($row['photo2']); ?>" alt="Property Image 2">
                </div>

                <div class="property-summary">
                    <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                    <div class="property-details">
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                        <p class="price"><strong>Price:</strong> <?php echo number_format($row['price'], 2); ?></p>
                        <p><strong>Contact:</strong> <?php echo htmlspecialchars($row['contact_info']); ?></p>
                    </div>
                </div>

                <!-- Separate Description Division -->
                <div class="property-description">
                    <h2>Description: </h2>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                </div>

            </div>
        <?php
        } else {
            echo "<p>No property found.</p>";
        }
        ?>
    </div>

    <footer>
        <h3>About Real Builders</h3>
        <p>REAL BUILDERS is your trusted partner in real estate development, sales, and consultation. Discover your dream property today!</p>
        <p>&copy; 2024 REAL BUILDERS. All rights reserved.</p>
    </footer>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
