<?php
include "../config/db.php";
include "../models/scouting.php";
$action = $_POST['action'] ?? '';

if ($action == "create") {
    scouting_create($conn, $_POST['player_id'], $_POST['scout_user_id'] ?? null, $_POST['tech'], $_POST['phys'], $_POST['ment'], $_POST['notes'] ?? null, $_POST['recommendation'] ?? null);
    header("Location: ../pages/scouting_form.php?msg=Report+created"); exit;
}
if ($action == "update") {
    scouting_update($conn, $_POST['id'], $_POST['tech'], $_POST['phys'], $_POST['ment'], $_POST['notes'] ?? null, $_POST['recommendation'] ?? null);
    header("Location: ../pages/scouting_form.php?msg=Report+updated"); exit;
}
if ($action == "delete") {
    scouting_delete($conn, $_POST['id']);
    header("Location: ../pages/scouting_form.php?msg=Report+deleted"); exit;
}
?>
