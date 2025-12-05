<?php
session_start();
include "../config/db.php"; // Make sure this connects properly

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'login') {
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        header("Location: ../pages/login.php?error=Email+and+password+required");
        exit;
    }

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' LIMIT 1");
    if (!$result) {
        die("Database error: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result);

    if ($user && $user['password'] === $password) {
        // Successful login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Optional: fetch user roles if you have user_roles table
        $roles = [];
        $roleRes = mysqli_query($conn, "SELECT r.name 
                                        FROM roles r 
                                        JOIN user_roles ur ON ur.role_id = r.id 
                                        WHERE ur.user_id = {$user['id']}");
        if ($roleRes) {
            while ($row = mysqli_fetch_assoc($roleRes)) {
                $roles[] = $row['name'];
            }
        }
        $_SESSION['roles'] = $roles;

        header("Location: ../pages/dashboard.php");
        exit;
    } else {
        // Invalid credentials
        header("Location: ../pages/login.php?error=Invalid+credentials");
        exit;
    }
}

if ($action === 'logout') {
    session_destroy();
    header("Location: ../pages/login.php?msg=Logged+out");
    exit;
}

// Fallback
header("Location: ../pages/login.php");
exit;
