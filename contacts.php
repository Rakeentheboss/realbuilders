<?php
session_start();
session_regenerate_id(true);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "realbuilders";

// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in to contact us.");
}

$user_id = $_SESSION['user_id'];

// Fetch user name and email from users table
$sql_user = "SELECT name, email FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$stmt_user->bind_result($name, $email);
$stmt_user->fetch();
$stmt_user->close();

// Initialize variables and errors
$message = "";
$message_err = "";

// Process the form when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter a message.";
    } else {
        $message = trim($_POST["message"]);
    }

    // If no errors, insert into contacts table and send email
    if (empty($message_err)) {
        $sql = "INSERT INTO contacts (user_id, message) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $user_id, $message);

        if ($stmt->execute()) {
            // Send email to admin
            $to = "islamrakeen8@gmail.com";  // Replace with actual admin email
            $subject = "New Contact Message from " . htmlspecialchars($name);
            $body = "You have received a new message from " . htmlspecialchars($name) . " (" . htmlspecialchars($email) . "):\n\n" . htmlspecialchars($message);
            $headers = "From: noreply@realbuilders.com\r\n"; // Change to a valid sender email
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            if (mail($to, $subject, $body, $headers)) {
                echo "<script>alert('Message sent successfully!');</script>";
            } else {
                echo "<script>alert('Failed to send email.');</script>";
            }
        } else {
            echo "<script>alert('Error saving message.');</script>";
        }

        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Real Builders</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
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
            margin: 0 15px;
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
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-group .error {
            color: red;
            font-size: 14px;
        }
        .submit-btn {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: darkred;
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
        <a href="yourproperties.php">View your Properties</a>
        <a href="aboutus.html">About Us</a>
    </nav>
</header>

<div class="container">
    <h2>Contact Us</h2>
    <form method="POST">
        <!-- Name field automatically populated from the database -->
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" value="<?php echo htmlspecialchars($name); ?>" disabled>
        </div>
        <!-- Email field automatically populated from the database -->
        <div class="form-group">
            <label for="email">Your Email</label>
            <input type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" disabled>
        </div>
        <!-- Message field -->
        <div class="form-group">
            <label for="message">Your Message</label>
            <textarea name="message" id="message" required><?php echo htmlspecialchars($message); ?></textarea>
            <span class="error"><?php echo $message_err; ?></span>
        </div>
        <button type="submit" class="submit-btn">Send Message</button>
    </form>
</div>

</body>
</html>
