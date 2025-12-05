<?php
// models/users.php
function user_create($conn, $name, $email, $password) {
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$hash')";
    return mysqli_query($conn, $sql);
}

function user_get_all($conn) {
    return mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
}

function user_get($conn, $id) {
    $id = (int)$id;
    return mysqli_query($conn, "SELECT * FROM users WHERE id=$id LIMIT 1");
}

function user_update($conn, $id, $name, $email) {
    $id = (int)$id;
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    return mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE id=$id");
}

function user_delete($conn, $id) {
    $id = (int)$id;
    return mysqli_query($conn, "DELETE FROM users WHERE id=$id");
}

// Login (prepared)
function user_find_by_email($conn, $email) {
    $sql = "SELECT id, name, email, password FROM users WHERE email = ? LIMIT 1";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($res);
    }
    return false;
}
?>
