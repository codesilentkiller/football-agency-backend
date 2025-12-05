<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); exit;
}
$error = $_GET['error'] ?? $_GET['msg'] ?? '';
?>
<!doctype html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php if($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="../controllers/auth.php">
        <input type="hidden" name="action" value="login">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button>Login</button>
    </form>
</div>

</body>
</html>
