<?php
include "../config/db.php";
include "../models/users.php";
$action = $_POST['action'] ?? '';

if ($action == "create") {
    user_create($conn, $_POST['name'], $_POST['email'], $_POST['password']);
    header("Location: ../index.php?msg=User+created"); exit;
}
if ($action == "update") {
    user_update($conn, $_POST['id'], $_POST['name'], $_POST['email']);
    header("Location: ../index.php?msg=User+updated"); exit;
}
if ($action == "delete") {
    user_delete($conn, $_POST['id']);
    header("Location: ../index.php?msg=User+deleted"); exit;
}
?>
