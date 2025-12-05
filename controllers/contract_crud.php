<?php

include "../config/db.php";
include "../models/contracts.php";

// fallback if nothing is sent
$action = isset($_POST['action']) ? $_POST['action'] : '';

/* -------------------------
   CREATE CONTRACT
-------------------------- */
if ($action == "create") {

    $player  = !empty($_POST['player_id']) ? $_POST['player_id'] : null;
    $club    = !empty($_POST['club_id']) ? $_POST['club_id'] : null;
    $agent   = !empty($_POST['agent_id']) ? $_POST['agent_id'] : null;
    $wage    = !empty($_POST['wage']) ? $_POST['wage'] : 0;
    $years   = !empty($_POST['years']) ? $_POST['years'] : 1;
    $add_on  = !empty($_POST['add_on']) ? $_POST['add_on'] : null;
    $start   = !empty($_POST['start_date']) ? $_POST['start_date'] : null;
    $end     = !empty($_POST['end_date']) ? $_POST['end_date'] : null;

    contract_create($conn, $player, $club, $agent, $wage, $years, $add_on, $start, $end);

    header("Location: ../pages/contracts_form.php?msg=Contract+created");
    exit;
}

/* -------------------------
   UPDATE CONTRACT
-------------------------- */
if ($action == "update") {

    $id     = isset($_POST['id']) ? $_POST['id'] : 0;
    $wage   = isset($_POST['wage']) ? $_POST['wage'] : 0;
    $years  = isset($_POST['years']) ? $_POST['years'] : 1;
    $add_on = !empty($_POST['add_on']) ? $_POST['add_on'] : null;

    contract_update($conn, $id, $wage, $years, $add_on);

    header("Location: ../pages/contracts_form.php?msg=Contract+updated");
    exit;
}

/* -------------------------
   DELETE CONTRACT
-------------------------- */
if ($action == "delete") {

    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    contract_delete($conn, $id);

    header("Location: ../pages/contracts_form.php?msg=Contract+deleted");
    exit;
}

?>
