<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please+login"); exit;
}
$name = $_SESSION['user_name'];
$roles = $_SESSION['roles'] ?? [];
?>
<!doctype html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container" style="max-width:650px;">
    <h1>Welcome, <?= htmlspecialchars($name) ?></h1>
    <p>Roles: <?= htmlspecialchars(implode(', ', $roles)) ?></p>
</div>

<div class="nav-box">
    <ul>
        <li><a href="roles_form.php">Manage Roles</a></li>
        <li><a href="permissions_form.php">Permissions</a></li>
        <li><a href="assign_role.php">Assign Role</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="transfers_form.php">Transfers</a></li>
        <li><a href="contracts_form.php">Contracts</a></li>
        <li><a href="scouting_form.php">Scouting</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

</body>
</html>
