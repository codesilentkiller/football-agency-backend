<?php
include "../config/db.php";
include "../models/role_permissions.php";
$action = $_POST['action'] ?? '';

if ($action == "assign") {
    rp_assign($conn, $_POST['role_id'], $_POST['permission_id']);
    header("Location: ../pages/roles_form.php?msg=Permission+assigned"); exit;
}
if ($action == "remove") {
    rp_remove($conn, $_POST['role_id'], $_POST['permission_id']);
    header("Location: ../pages/roles_form.php?msg=Permission+removed"); exit;
}
?>
