<?php
// models/role_permissions.php
function rp_assign($conn, $role_id, $perm_id) {
    $r = (int)$role_id; $p = (int)$perm_id;
    // ignore duplicate errors
    return mysqli_query($conn, "INSERT IGNORE INTO role_permissions (role_id,permission_id) VALUES ($r,$p)");
}

function rp_remove($conn, $role_id, $perm_id) {
    $r = (int)$role_id; $p = (int)$perm_id;
    return mysqli_query($conn, "DELETE FROM role_permissions WHERE role_id=$r AND permission_id=$p");
}

function rp_for_role($conn, $role_id) {
    $r = (int)$role_id;
    return mysqli_query($conn, "SELECT p.* FROM permissions p JOIN role_permissions rp ON p.id=rp.permission_id WHERE rp.role_id=$r");
}
?>
