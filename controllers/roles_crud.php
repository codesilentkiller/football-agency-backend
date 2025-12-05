<?php
include "../config/db.php";
include "../models/roles.php";
$action = $_POST['action'] ?? '';

if ($action == "create") {
    role_create($conn, $_POST['name'], $_POST['description'] ?? null);
    header("Location: ../pages/roles_form.php?msg=Role+created"); exit;
}
if ($action == "update") {
    role_update($conn, $_POST['id'], $_POST['name'], $_POST['description'] ?? null);
    header("Location: ../pages/roles_form.php?msg=Role+updated"); exit;
}
if ($action == "delete") {
    role_delete($conn, $_POST['id']);
    header("Location: ../pages/roles_form.php?msg=Role+deleted"); exit;
}
?>
