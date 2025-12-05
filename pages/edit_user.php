<?php
session_start();
include "../config/db.php";

// Ensure admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get user ID from query string
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($user_id <= 0) {
    die("Invalid user ID.");
}

// Fetch user data
$result = mysqli_query($conn, "SELECT id, name, email FROM users WHERE id = $user_id LIMIT 1");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // may be empty

    if (!$name || !$email) {
        $error = "Name and Email are required.";
    } else {
        // Check if email is used by another user
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' AND id != $user_id");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email is already in use by another user.";
        } else {
            // Build update query
            if ($password) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $update = "UPDATE users SET name='$name', email='$email', password='$hashed_password' WHERE id=$user_id";
            } else {
                $update = "UPDATE users SET name='$name', email='$email' WHERE id=$user_id";
            }

            if (mysqli_query($conn, $update)) {
                $success = "User details updated successfully!";
                // Refresh user data
                $result = mysqli_query($conn, "SELECT id, name, email FROM users WHERE id = $user_id LIMIT 1");
                $user = mysqli_fetch_assoc($result);
            } else {
                $error = "Database error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit User - Admin</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #111;
        color: #eee;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 500px;
        margin: 60px auto;
        background-color: #1a1a1a;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.6);
    }
    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #fff;
        text-shadow: 1px 1px 3px #000;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #ccc;
    }
    input {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 8px;
        border: 1px solid #333;
        background-color: #222;
        color: #fff;
        transition: all 0.2s;
    }
    input:focus {
        border-color: #fff;
        box-shadow: 0 0 10px #fff55c33;
        outline: none;
    }
    button {
        width: 100%;
        padding: 12px;
        background-color: #000;
        color: #fff;
        font-weight: bold;
        border: 1px solid #fff;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 0 5px #fff33, 0 0 15px #fff22 inset;
    }
    button:hover {
        background-color: #111;
        box-shadow: 0 0 20px #fff, 0 0 30px #fff inset;
    }
    .message {
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 6px;
        text-align: center;
    }
    .error {
        background-color: #ff3333;
        color: #fff;
    }
    .success {
        background-color: #33cc33;
        color: #fff;
    }
    a {
        color: #fff;
        text-decoration: none;
        display: block;
        text-align: center;
        margin-top: 10px;
        font-weight: 600;
    }
    a:hover { color: #ffcc00; }
</style>
</head>
<body>
<div class="container">
    <h2>Edit User</h2>

    <?php if($error): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if($success): ?>
        <div class="message success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <label>Password (leave blank to keep current)</label>
        <input type="password" name="password">

        <button type="submit">Update User</button>
    </form>

    <a href="users.php">Back to Users</a>
</div>
</body>
</html>
