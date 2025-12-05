<?php
// pages/auth_check.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please+login"); exit;
}
?>
