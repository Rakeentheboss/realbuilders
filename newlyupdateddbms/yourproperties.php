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

// Function to fetch properties
function fetchProperties($conn, $username, $typeCondition) {
    $sql = "SELECT * FROM property WHERE username = ? AND $typeCondition";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    return $stmt->get_result();
}

// Fetch properties
$nonRentProperties = fetchProperties($conn, $username, "`Type` <> 'Rent'");
$rentProperties = fetchProperties($conn, $username, "`Type` = 'Rent'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Real Builders</title>
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
        header h1 { font-size: 26px; font-weight: 600; }
        header nav a, header .sign-in {
            text-decoration: none; color: #333; margin: 0 20px; font-size: 16px;
            font-weight: 500; padding: 10px 20px; border: 2px solid #ccc;
            border-radius: 25px; transition: background 0.3s, color 0.3s, border-color 0.3s;
        }
        header nav a:hover, header .sign-in:hover { background: red; color: #fff; border-color: red; }
        .section { padding: 40px 50px; text-align: center; }
        .card-container { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
        .card {
            width: 280px; background: #fff; border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); overflow: hidden; text-align: left;
            transition: transform 0.3s;
        }
        .card:hover { transform: scale(1.05); }
        .card img { width: 100%; height: 180px; object-fit: cover; }
        .card-content { padding: 15px; }
        .view-details {
            display: inline-block; padding: 10px 25px; border: 2px solid #333;
            border-radius: 25px; text-decoration: none; font-size: 16px;
            font-weight: 500; color: #333; transition: background 0.3s, color 0.3s;
        }
        .view-details:hover { background: #333; color: #fff; }
    </style>
</head>
<body>
    <header>
        <h1>REAL BUILDERS - Dashboard</h1>
        <nav>
            <a href="mb.php">Home</a>
            <a href="buy.html">Buy</a>
            <a href="viewsell.php">Sell</a>
            <a href="viewrent.php">Rent</a>
            <a href="designers.html">Interior Design Solutions</a>
            <a href="about us.html">About Us</a>
        </nav>
        <a href="logout.php" class="sign-in">Logout</a>
    </header>

    <section class="section">
        <h2>Welcome,<?php echo htmlspecialchars($username); ?>  You have sold the following properties</h2>
        <a href="sell.html">Sell a new property</a>
        <div class="card-container">
            <?php while ($row = $nonRentProperties->fetch_assoc()): ?>
                <div class="card">
                    <img src="sell/<?php echo htmlspecialchars($row['photo'] ?: 'default.jpg'); ?>" alt="Property Image">
                    <div class="card-content">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p>Location: <?php echo htmlspecialchars($row['location']); ?></p>
                        <p>Type: <?php echo htmlspecialchars($row['type']); ?></p>
                        <p>Price: <?php echo htmlspecialchars($row['price']); ?></p>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button type="submit" class="view-details">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <section class="section">
        <h2>You have rented the following properties</h2>
        <a href="rent0.html">Rent a new property</a>
        <div class="card-container">
            <?php while ($row = $rentProperties->fetch_assoc()): ?>
                <div class="card">
                    <img src="sell/<?php echo htmlspecialchars($row['photo'] ?: 'default.jpg'); ?>" alt="Property Image">
                    <div class="card-content">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p>Location: <?php echo htmlspecialchars($row['location']); ?></p>
                        <p>Type: <?php echo htmlspecialchars($row['type']); ?></p>
                        <p>Price: <?php echo htmlspecialchars($row['price']); ?></p>
                        <p>Contact_info: <?php echo htmlspecialchars($row['contact_info']); ?></p>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button type="submit" class="view-details">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 REAL BUILDERS. All rights reserved.</p>
    </footer>
</body>
</html>
<?php
$conn->close();
?>
