<?php
include "config/db.php";
include "models/users.php";
include "models/roles.php";
include "models/permissions.php";
include "models/user_roles.php";
include "models/role_permissions.php";

// create some users
$user_list = [
  ['John Admin','admin1@agency.com','admin123'],
  ['Sarah Admin','admin2@agency.com','admin123'],
  ['Lionel Messi','messi@player.com','player123'],
  ['Cristiano Ronaldo','ronaldo@player.com','player123'],
  ['Jorge Mendes','mendes@agent.com','agent123'],
  ['Mino Raiola','raiola@agent.com','agent123'],
  ['Pep Guardiola','pep@club.com','club123'],
  ['Jurgen Klopp','klopp@club.com','club123']
];

foreach ($user_list as $u) {
    // ignore duplicates
    user_create($conn, $u[0], $u[1], $u[2]);
}

// roles
$roles = ['Admin'=>'System administrator','Player'=>'Football player','Agent'=>'Player agent','Club_Manager'=>'Club official','Scout'=>'Scout'];
foreach ($roles as $name => $desc) role_create($conn, $name, $desc);

// permissions example
permission_create($conn, 'manage_users', 'Create/Update/Delete users');
permission_create($conn, 'manage_transfers', 'Approve or reject transfers');
permission_create($conn, 'create_reports', 'Create scouting reports');

// assign Admin perms to Admin role
// find id helpers (quick & simple)
$rRes = mysqli_query($conn,"SELECT id FROM roles WHERE name='Admin' LIMIT 1"); $rRow = mysqli_fetch_assoc($rRes); $admin_id = $rRow['id'];
$pRes = mysqli_query($conn,"SELECT id FROM permissions");
while ($p = mysqli_fetch_assoc($pRes)) rp_assign($conn, $admin_id, $p['id']);

// assign roles to users
$uRes = mysqli_query($conn,"SELECT id,email FROM users");
while ($row = mysqli_fetch_assoc($uRes)) {
    $email = $row['email'];
    $uid = $row['id'];
    if (strpos($email,'admin') !== false) {
        ur_assign($conn, $uid, $admin_id);
    } elseif (strpos($email,'player') !== false || strpos($email,'messi')!==false || strpos($email,'ronaldo')!==false) {
        $r = mysqli_query($conn,"SELECT id FROM roles WHERE name='Player' LIMIT 1"); $rr=mysqli_fetch_assoc($r); ur_assign($conn,$uid,$rr['id']);
    } elseif (strpos($email,'agent') !== false) {
        $r = mysqli_query($conn,"SELECT id FROM roles WHERE name='Agent' LIMIT 1"); $rr=mysqli_fetch_assoc($r); ur_assign($conn,$uid,$rr['id']);
    } elseif (strpos($email,'club') !== false) {
        $r = mysqli_query($conn,"SELECT id FROM roles WHERE name='Club_Manager' LIMIT 1"); $rr=mysqli_fetch_assoc($r); ur_assign($conn,$uid,$rr['id']);
    }
}

echo "Sample data seeded.";
?>
