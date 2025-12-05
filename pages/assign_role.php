<?php
include "db.php";

// ASSIGN ROLE
if (isset($_POST['assign'])) {
    $user_id = $_POST['user_id'];
    $role_id = $_POST['role_id'];
    mysqli_query($conn, "INSERT INTO user_roles (user_id, role_id) VALUES ($user_id, $role_id)");
}

// DELETE ROLE ASSIGNMENT
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM user_roles WHERE id=$id");
}
?>

<form method="post">
    <select name="user_id">
        <?php
        $u = mysqli_query($conn, "SELECT * FROM users");
        while ($x = mysqli_fetch_assoc($u)): ?>
            <option value="<?= $x['id'] ?>"><?= $x['name'] ?></option>
        <?php endwhile; ?>
    </select>

    <select name="role_id">
        <?php
        $r = mysqli_query($conn, "SELECT * FROM roles");
        while ($x = mysqli_fetch_assoc($r)): ?>
            <option value="<?= $x['id'] ?>"><?= $x['name'] ?></option>
        <?php endwhile; ?>
    </select>

    <button name="assign">Assign Role</button>
</form>

<hr>

<table border="1">
<tr><th>User</th><th>Role</th><th>Action</th></tr>
<?php
$q = mysqli_query($conn, "SELECT user_roles.id, users.name as usern, roles.name as rolen 
FROM user_roles 
JOIN users ON users.id=user_roles.user_id 
JOIN roles ON roles.id=user_roles.role_id");
while ($row = mysqli_fetch_assoc($q)): ?>
<tr>
    <td><?= $row['usern'] ?></td>
    <td><?= $row['rolen'] ?></td>
    <td><a href="?remove=<?= $row['id'] ?>">Remove</a></td>
</tr>
<?php endwhile; ?>
</table>
