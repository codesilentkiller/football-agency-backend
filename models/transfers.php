<?php
// models/transfers.php
function transfer_create($conn, $player_id, $agent_id, $old_club_id, $new_club_id, $fee, $status='pending') {
    $p=(int)$player_id; $a=$agent_id? (int)$agent_id : "NULL";
    $oc=$old_club_id? (int)$old_club_id : "NULL"; $nc=$new_club_id? (int)$new_club_id : "NULL";
    $f = (float)$fee;
    $s = mysqli_real_escape_string($conn, $status);
    return mysqli_query($conn, "INSERT INTO transfers (player_id, agent_id, old_club_id, new_club_id, fee, status) VALUES ($p, $a, $oc, $nc, $f, '$s')");
}

function transfer_all($conn) {
    return mysqli_query($conn, "SELECT * FROM transfers ORDER BY created_at DESC");
}

function transfer_get($conn, $id) {
    $id=(int)$id;
    return mysqli_query($conn, "SELECT * FROM transfers WHERE id=$id LIMIT 1");
}

function transfer_update_status($conn, $id, $status) {
    $id=(int)$id;
    $s = mysqli_real_escape_string($conn, $status);
    return mysqli_query($conn, "UPDATE transfers SET status='$s' WHERE id=$id");
}

function transfer_delete($conn, $id) {
    $id=(int)$id;
    return mysqli_query($conn, "DELETE FROM transfers WHERE id=$id");
}
?>
