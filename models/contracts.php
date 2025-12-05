<?php
// models/contracts.php
function contract_create($conn, $player_id, $club_id, $agent_id, $wage, $years, $add_on, $start, $end) {
    $p=(int)$player_id; $c=$club_id ? (int)$club_id : "NULL"; $a=$agent_id ? (int)$agent_id : "NULL";
    $w=(float)$wage; $y=(int)$years;
    $add = $add_on ? "'" . mysqli_real_escape_string($conn,$add_on) . "'" : "NULL";
    $s = $start ? "'" . mysqli_real_escape_string($conn,$start) . "'" : "NULL";
    $e = $end ? "'" . mysqli_real_escape_string($conn,$end) . "'" : "NULL";
    return mysqli_query($conn, "INSERT INTO contracts (player_id, club_id, agent_id, wage, contract_years, add_on_clauses, start_date, end_date) VALUES ($p, $c, $a, $w, $y, $add, $s, $e)");
}

function contract_all($conn) {
    return mysqli_query($conn, "SELECT * FROM contracts ORDER BY created_at DESC");
}

function contract_get($conn, $id) {
    $id=(int)$id;
    return mysqli_query($conn, "SELECT * FROM contracts WHERE id=$id LIMIT 1");
}

function contract_update($conn, $id, $wage, $years, $add_on) {
    $id=(int)$id; $w=(float)$wage; $y=(int)$years; $a = $add_on ? "'" . mysqli_real_escape_string($conn,$add_on) . "'" : "NULL";
    return mysqli_query($conn, "UPDATE contracts SET wage=$w, contract_years=$y, add_on_clauses=$a WHERE id=$id");
}

function contract_delete($conn, $id) {
    $id=(int)$id;
    return mysqli_query($conn, "DELETE FROM contracts WHERE id=$id");
}
?>
