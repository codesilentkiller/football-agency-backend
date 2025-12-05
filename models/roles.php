<?php
// models/roles.php
function role_create($conn, $name, $desc = null) {
    $n = mysqli_real_escape_string($conn, $name);
    $d = $desc ? "'" . mysqli_real_escape_string($conn, $desc) . "'" : "NULL";
    return mysqli_query($conn, "INSERT INTO roles (name,description) VALUES ('$n',$d)");
}

function role_all($conn) {
    return mysqli_query($conn, "SELECT * FROM roles ORDER BY id");
}

function role_get($conn, $id) {
    $id = (int)$id;
    return mysqli_query($conn, "SELECT * FROM roles WHERE id=$id LIMIT 1");
}

function role_update($conn, $id, $name, $desc = null) {
    $id = (int)$id;
    $n = mysqli_real_escape_string($conn, $name);
    $d = $desc ? "'" . mysqli_real_escape_string($conn, $desc) . "'" : "NULL";
    return mysqli_query($conn, "UPDATE roles SET name='$n', description=$d WHERE id=$id");
}

function role_delete($conn, $id) {
    $id = (int)$id;
    return mysqli_query($conn, "DELETE FROM roles WHERE id=$id");
}
?>
