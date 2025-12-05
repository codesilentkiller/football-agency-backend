<?php
include "../config/db.php";
include "../models/user_roles.php";
$action = $_POST['action'] ?? '';

if ($action == "assign") {
    ur_assign($conn, $_POST['user_id'], $_POST['role_id']);
    header("Location: ../pages/assign_role.php?msg=Role+assigned"); exit;
}
if ($action == "remove") {
    ur_remove($conn, $_POST['user_id'], $_POST['role_id']);
    header("Location: ../pages/assign_role.php?msg=Role+removed"); exit;
}
?>
