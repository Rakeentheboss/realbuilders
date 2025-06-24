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

// Fetch comments with replies
$sql = "SELECT * FROM comments ORDER BY created_at DESC";
$comments = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Feedback & Reviews - Real Builders</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .comment {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .reply-container {
            margin-left: 20px;
            padding: 5px 0;
        }
        .reply-form {
            margin-top: 10px;
            display: none;
        }
        button {
            cursor: pointer;
            padding: 5px 10px;
            border: none;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Client Feedback & Reviews</h2>

    <!-- Display comments -->
    <?php while ($comment = $comments->fetch_assoc()): ?>
        <div class="comment">
            <strong><?= htmlspecialchars($comment['username']) ?>:</strong>
            <p><?= htmlspecialchars($comment['comment']) ?></p>
            <button class="reply-btn" data-id="<?= $comment['id'] ?>">Reply</button>

            <!-- Reply form -->
            <div class="reply-form" id="reply-form-<?= $comment['id'] ?>">
                <input type="text" class="reply-username" placeholder="Your Name">
                <textarea class="reply-text" rows="2" placeholder="Write your reply..."></textarea>
                <button class="submit-reply" data-id="<?= $comment['id'] ?>">Submit Reply</button>
            </div>

            <!-- Display replies -->
            <div class="reply-container" id="replies-<?= $comment['id'] ?>">
                <?php
                $comment_id = $comment['id'];
                $reply_sql = "SELECT * FROM replies WHERE comment_id = $comment_id ORDER BY created_at ASC";
                $replies = $conn->query($reply_sql);
                while ($reply = $replies->fetch_assoc()):
                ?>
                    <div class="reply">
                        <strong><?= htmlspecialchars($reply['username']) ?>:</strong>
                        <p><?= htmlspecialchars($reply['reply']) ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<script>
    $(document).ready(function() {
        // Show reply form when "Reply" button is clicked
        $(".reply-btn").click(function() {
            var id = $(this).data("id");
            $("#reply-form-" + id).slideToggle();
        });

        // Submit reply via AJAX
        $(".submit-reply").click(function() {
            var id = $(this).data("id");
            var username = $("#reply-form-" + id + " .reply-username").val();
            var replyText = $("#reply-form-" + id + " .reply-text").val();

            if (username.trim() === "" || replyText.trim() === "") {
                alert("Please enter both name and reply.");
                return;
            }

            $.post("submit_reply.php", { comment_id: id, username: username, reply: replyText }, function(response) {
                var data = JSON.parse(response);
                if (data.status === "success") {
                    $("#replies-" + id).append(
                        "<div class='reply'><strong>" + username + ":</strong><p>" + replyText + "</p></div>"
                    );
                    $("#reply-form-" + id + " .reply-username").val("");
                    $("#reply-form-" + id + " .reply-text").val("");
                    $("#reply-form-" + id).slideUp();
                } else {
                    alert("Error submitting reply. Please try again.");
                }
            });
        });
    });
</script>

</body>
</html>
