<?php
// models/permissions.php
function permission_create($conn, $name, $desc = null) {
    $n = mysqli_real_escape_string($conn,$name);
    $d = $desc ? "'" . mysqli_real_escape_string($conn,$desc) . "'" : "NULL";
    return mysqli_query($conn, "INSERT INTO permissions (name,description) VALUES ('$n',$d)");
}

function permission_all($conn) {
    return mysqli_query($conn, "SELECT * FROM permissions ORDER BY id");
}

function permission_get($conn, $id) {
    $id = (int)$id;
    return mysqli_query($conn, "SELECT * FROM permissions WHERE id=$id LIMIT 1");
}

function permission_update($conn, $id, $name, $desc = null) {
    $id = (int)$id;
    $n = mysqli_real_escape_string($conn,$name);
    $d = $desc ? "'" . mysqli_real_escape_string($conn,$desc) . "'" : "NULL";
    return mysqli_query($conn, "UPDATE permissions SET name='$n', description=$d WHERE id=$id");
}

function permission_delete($conn, $id) {
    $id = (int)$id;
    return mysqli_query($conn, "DELETE FROM permissions WHERE id=$id");
}
?>
