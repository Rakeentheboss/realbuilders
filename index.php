<?php
session_start();

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    // Redirect logged-in user to user_home.html
    header("Location: mb.php");
    exit;
} else {
    // Redirect to login page if not logged in
    header("Location: signin.html");
    exit;
}
?>

