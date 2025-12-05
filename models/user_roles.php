<?php
// models/user_roles.php
function ur_assign($conn, $user_id, $role_id) {
    $u = (int)$user_id; $r = (int)$role_id;
    return mysqli_query($conn, "INSERT IGNORE INTO user_roles (user_id, role_id) VALUES ($u,$r)");
}

function ur_remove($conn, $user_id, $role_id) {
    $u = (int)$user_id; $r = (int)$role_id;
    return mysqli_query($conn, "DELETE FROM user_roles WHERE user_id=$u AND role_id=$r");
}

function ur_roles_for_user($conn, $user_id) {
    $u = (int)$user_id;
    return mysqli_query($conn, "SELECT r.* FROM roles r JOIN user_roles ur ON r.id=ur.role_id WHERE ur.user_id=$u");
}

function ur_users_for_role($conn, $role_id) {
    $r = (int)$role_id;
    return mysqli_query($conn, "SELECT u.* FROM users u JOIN user_roles ur ON u.id=ur.user_id WHERE ur.role_id=$r");
}
?>
