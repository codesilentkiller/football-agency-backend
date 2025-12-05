<?php
include "../config/db.php";
include "../models/permissions.php";
$action = $_POST['action'] ?? '';

if ($action == "create") {
    permission_create($conn, $_POST['name'], $_POST['description'] ?? null);
    header("Location: ../pages/permissions_form.php?msg=Perm+created"); exit;
}
if ($action == "update") {
    permission_update($conn, $_POST['id'], $_POST['name'], $_POST['description'] ?? null);
    header("Location: ../pages/permissions_form.php?msg=Perm+updated"); exit;
}
if ($action == "delete") {
    permission_delete($conn, $_POST['id']);
    header("Location: ../pages/permissions_form.php?msg=Perm+deleted"); exit;
}
?>
