<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Builders</title>
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
    justify-content: flex-start;
    gap: 20px;
    flex-wrap: nowrap; /* Prevent wrapping */
    overflow-x: auto; /* Enable horizontal scrolling */
    scroll-behavior: smooth;
    padding: 10px;
    white-space: nowrap;
        }

        .card-container1 {
    display: flex; /* Use flexbox */
    justify-content: center; /* Center align horizontally */
    align-items: center; /* Center align vertically (optional) */
    gap: 20px;
    scroll-behavior: smooth;
    padding: 10px;
    white-space: nowrap; /* Prevent line breaks */
    overflow-x: auto; /* Enable horizontal scrolling */
}

        .card {
            width: 280px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            text-align: left;
            transition: transform 0.3s;
            flex-shrink: 0;
            
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
        .about-section {
            background-color: #f2f2f2;
            padding: 20px 50px;
            text-align: center;
            color: #555;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }
        .button-container a:hover {
            background: #333;
            color: #fff;
        }
        .button-container {
            margin: 20px 0;
        }

        .button-container a {
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
        
        
        .footer {
            background: #333;
            color: #fff;
            padding: 30px 50px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <div>
            <h1>REAL BUILDERS</h1>
        </div>
        
        <nav>
            <a href="buy.html">FlexiDeal</a>
            <a href="viewsell.php">Sell</a>
            <a href="viewrent.php">Rent</a>
            <a href="designers.html">Interior Design Solutions</a>
            <a href="yourproperties.php">View your properties</a>
            <a href="about us.html">About Us</a>
        </nav>

        <div>
            <a href="signin.html" class="sign-in" id="logout">Logout</a>
        </div>
    </header>

    
        <section class="section">
    <h2>We've Got Properties For Everyone!</h2>
    
    <?php
// Database connection
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

// Query to get the property count
$propertyCountQuery = "SELECT COUNT(*) AS property_count FROM property";
$propertyCountResult = $conn->query($propertyCountQuery);
if ($propertyCountResult->num_rows > 0) {
    $propertyCountRow = $propertyCountResult->fetch_assoc();
    $propertyCount = $propertyCountRow['property_count'];
} else {
    $propertyCount = 0;
}

// Query to get the user count
$userCountQuery = "SELECT COUNT(*) AS user_count FROM register";
$userCountResult = $conn->query($userCountQuery);
if ($userCountResult->num_rows > 0) {
    $userCountRow = $userCountResult->fetch_assoc();
    $userCount = $userCountRow['user_count'];
} else {
    $userCount = 0;
}

// Close the connection after fetching the counts
$conn->close();
?>
<div style="display: flex; align-items: center; gap: 20px; justify-content: center;">
    <div style="text-align: center;">
        <img src="house.jpg" alt="House Image" width="100" height="100">
        <p style="font-weight: 600; margin-top: 10px;">Total Properties: <?php echo $propertyCount; ?></p>
    </div>

    <div style="text-align: center;">
        <img src="user.png" alt="User Image" width="100" height="100">
        <p style="font-weight: 600; margin-top: 10px;">Total Users: <?php echo $userCount; ?></p>
    </div>
</div>


    <div class="card-container" id="propertyCards">
        <!-- Dynamic property cards from PHP will be inserted here -->
        <?php include 'mb2.php'; ?>
    </div>
    
    <!-- Button -->
    <div class="button-container">
        <a href="<?php echo $propertyLink; ?>">View Details</a>
    </div>
</section>




    </section>

    <section class="section">
        <h2>Find Our Designers And Decorate Your Home</h2>
        <div class="card-container1">
            <div class="card">
                <img src="designer/1.jpg" alt="Designer 1">
                <div class="card-content">
                    <h3>Sheikh Abdullah</h3>
                </div>
            </div>
            <div class="card">
                <img src="designer/2.jpg" alt="Designer 2">
                <div class="card-content">
                    <h3>Samew Sparrow</h3>
                </div>
            </div>
            <div class="card">
                <img src="designer/3.webp" alt="Designer 3">
                <div class="card-content">
                    <h3>Nicolas Jackson</h3>
                </div>
            </div>
        </div>
        <div class="button-container">
            <a href="designers.html">See All Designers</a>
        </div>
    </section>

    <div class="about-section">
        <h3>About Real Builders</h3>
        <p>Welcome to REAL BUILDERS, your trusted partner in real estate development, sales and consultation. With a legacy of excellence and a commitment to quality, we have been transforming dreams into reality by creating spaces where people live, work and thrive.</p>
    </div>

    <footer class="footer">
        <p>&copy; 2024 REAL BUILDERS. All rights reserved.</p>
    </footer>


    <script>

document.addEventListener('DOMContentLoaded', function() {
        // Check if the user is logged in
        if (!sessionStorage.getItem('isLoggedIn')) {
            window.location.href = 'signin.html'; // Redirect to login page if not logged in
        }






        // Logout action
        document.getElementById('logout').addEventListener('click', function() {
            // Clear sessionStorage when logging out
            sessionStorage.clear();
            alert('Logged out');
            window.location.href = 'signin.html'; // Redirect to login page after logout
        });
    });

    console.log("isLoggedIn:", sessionStorage.getItem('isLoggedIn'));
console.log("username:", sessionStorage.getItem('username'));


    </script>
</body>
</html>


    