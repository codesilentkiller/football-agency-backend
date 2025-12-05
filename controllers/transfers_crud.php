<?php
include "../config/db.php";
include "../models/transfers.php";
$action = $_POST['action'] ?? '';

if ($action == "create") {
    transfer_create($conn, $_POST['player_id'], $_POST['agent_id'] ?? null, $_POST['old_club_id'] ?? null, $_POST['new_club_id'] ?? null, $_POST['fee'] ?? 0);
    header("Location: ../pages/transfers_form.php?msg=Transfer+created"); exit;
}
if ($action == "update_status") {
    transfer_update_status($conn, $_POST['id'], $_POST['status']);
    header("Location: ../pages/transfers_form.php?msg=Status+updated"); exit;
}
if ($action == "delete") {
    transfer_delete($conn, $_POST['id']);
    header("Location: ../pages/transfers_form.php?msg=Transfer+deleted"); exit;
}
?>
