<?php
// Database connection
$host = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$database = "realbuilders";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Accept/Decline Requests
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && isset($_POST['property_id'])) {
    $property_id = intval($_POST['property_id']);
    $status = ($_POST['action'] == 'accept') ? 'accepted' : 'declined';

    // Use prepared statement to insert or update status
    $stmt = $conn->prepare("INSERT INTO accepted_property (id, status) VALUES (?, ?) 
                            ON DUPLICATE KEY UPDATE status=?");
    $stmt->bind_param("iss", $property_id, $status, $status);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo json_encode(["status" => "success", "property_id" => $property_id, "action" => $status]);
    } else {
        echo json_encode(["status" => "error"]);
    }

    $stmt->close();
    $conn->close();
    exit;
}

// Fetch Properties with Status
$sql = "SELECT p.*, ap.status FROM property p 
        LEFT JOIN accepted_property ap ON p.id = ap.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RealBuilders Property List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        img { max-width: 100px; }
        button { padding: 5px 10px; cursor: pointer; margin: 2px; }
        button:disabled { background-color: grey; cursor: not-allowed; }
    </style>
</head>
<body>

<h2>Property Listings</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Location</th>
        <th>Price</th>
        <th>Contact</th>
        <th>Photo</th>
        <th>Ownership Docs</th>
        <th>Lease Agreement</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr id="row-<?= $row['id'] ?>">
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['location']) ?></td>
            <td>$<?= number_format($row['price'], 2) ?></td>
            <td><?= htmlspecialchars($row['contact_info']) ?></td>
            <td><img src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo"></td>
            <td><a href="<?= htmlspecialchars($row['ownership_documents_path']) ?>" target="_blank">View</a></td>
            <td><a href="<?= htmlspecialchars($row['lease_agreement_path']) ?>" target="_blank">View</a></td>
            <td>
                <button class="accept-btn" data-id="<?= $row['id'] ?>" <?= ($row['status'] == 'accepted') ? 'disabled' : '' ?>>
                    <?= ($row['status'] == 'accepted') ? 'Accepted' : 'Accept' ?>
                </button>
                <button class="decline-btn" data-id="<?= $row['id'] ?>" <?= ($row['status'] == 'declined') ? 'disabled' : '' ?>>
                    <?= ($row['status'] == 'declined') ? 'Declined' : 'Decline' ?>
                </button>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<script>
    $(document).ready(function() {
        $(".accept-btn, .decline-btn").click(function() {
            var propertyId = $(this).data("id");
            var action = $(this).hasClass("accept-btn") ? "accept" : "decline";
            var button = $(this);

            $.post("clientactivity.php", { action: action, property_id: propertyId }, function(response) {
                var data = JSON.parse(response);

                if (data.status === "success") {
                    if (data.action === "accepted") {
                        $("#row-" + data.property_id + " .accept-btn").text("Accepted").prop("disabled", true);
                        $("#row-" + data.property_id + " .decline-btn").text("Decline").prop("disabled", false);
                    } else {
                        $("#row-" + data.property_id + " .decline-btn").text("Declined").prop("disabled", true);
                        $("#row-" + data.property_id + " .accept-btn").text("Accept").prop("disabled", false);
                    }
                } else {
                    alert("Error updating property status. Please try again.");
                }
            });
        });
    });
</script>

</body>
</html>
