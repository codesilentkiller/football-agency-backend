<?php
// models/scouting.php
function scouting_create($conn, $player_id, $scout_user_id, $tech, $phys, $ment, $notes, $recommendation) {
    $p=(int)$player_id; $s = $scout_user_id ? (int)$scout_user_id : "NULL";
    $tech = (int)$tech; $phys = (int)$phys; $ment = (int)$ment;
    $n = $notes ? "'" . mysqli_real_escape_string($conn,$notes) . "'" : "NULL";
    $r = $recommendation ? "'" . mysqli_real_escape_string($conn,$recommendation) . "'" : "NULL";
    return mysqli_query($conn, "INSERT INTO scouting_reports (player_id, scout_user_id, technical_score, physical_score, mental_score, notes, recommendation) VALUES ($p, $s, $tech, $phys, $ment, $n, $r)");
}

function scouting_all($conn) {
    return mysqli_query($conn, "SELECT * FROM scouting_reports ORDER BY created_at DESC");
}

function scouting_get($conn, $id) {
    $id=(int)$id;
    return mysqli_query($conn, "SELECT * FROM scouting_reports WHERE id=$id LIMIT 1");
}

function scouting_update($conn, $id, $tech, $phys, $ment, $notes, $recommendation) {
    $id=(int)$id;
    $n = $notes ? "'" . mysqli_real_escape_string($conn,$notes) . "'" : "NULL";
    $r = $recommendation ? "'" . mysqli_real_escape_string($conn,$recommendation) . "'" : "NULL";
    return mysqli_query($conn, "UPDATE scouting_reports SET technical_score=$tech, physical_score=$phys, mental_score=$ment, notes=$n, recommendation=$r WHERE id=$id");
}

function scouting_delete($conn, $id) {
    $id=(int)$id;
    return mysqli_query($conn, "DELETE FROM scouting_reports WHERE id=$id");
}
?>
