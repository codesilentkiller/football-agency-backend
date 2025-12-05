<?php
include "../config/db.php";

// ADD PERMISSION
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    mysqli_query($conn, "INSERT INTO permissions (name) VALUES ('$name')");
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM permissions WHERE id=$id");
}

// EDIT
$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM permissions WHERE id=$id"));
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    mysqli_query($conn, "UPDATE permissions SET name='$name' WHERE id=$id");
}
?>

<form method="post">
    <input type="text" name="name" value="<?= $edit['name'] ?? '' ?>" placeholder="Permission name">
    <?php if ($edit): ?>
        <input type="hidden" name="id" value="<?= $edit['id'] ?>">
        <button name="update">Update</button>
    <?php else: ?>
        <button name="save">Save</button>
    <?php endif; ?>
</form>

<table border="1">
<tr><th>ID</th><th>Name</th><th>Action</th></tr>
<?php
$q = mysqli_query($conn, "SELECT * FROM permissions");
while ($row = mysqli_fetch_assoc($q)): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td>
        <a href="?edit=<?= $row['id'] ?>">Edit</a>
        <a href="?delete=<?= $row['id'] ?>">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
