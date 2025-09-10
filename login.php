<?php
session_start();
include 'db.php';
include 'Models/User.php';

$db = new Database();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Attempt to login the user
    $loggedInUser = $user->login($email, $password);
    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['id']; // Store user ID in session
        header('Location: dashboard.php'); // Redirect to the dashboard
        exit;
    } else {
        $error = "Email atau password salah."; // Error message for failed login
    }
}

// Include the HTML form
include 'Views/Forms/form_login.php';
