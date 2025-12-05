<?php
include "../config/db.php";


if (isset($_POST['save'])) {
    mysqli_query($conn, "INSERT INTO scouting (player, position, rating, notes)
    VALUES ('{$_POST['player']}', '{$_POST['position']}', '{$_POST['rating']}', '{$_POST['notes']}')");
}

if (isset($_GET['delete'])) {
    mysqli_query($conn, "DELETE FROM scouting WHERE id=".$_GET['delete']);
}

$edit = null;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM scouting WHERE id=".$_GET['edit']));
}

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE scouting SET 
        player='{$_POST['player']}',
        position='{$_POST['position']}',
        rating='{$_POST['rating']}',
        notes='{$_POST['notes']}'
    WHERE id={$_POST['id']}");
}
?>

<form method="post">
<input name="player" placeholder="Player" value="<?= $edit['player'] ?? '' ?>">
<input name="position" placeholder="Position" value="<?= $edit['position'] ?? '' ?>">
<input name="rating" placeholder="Rating /10" value="<?= $edit['rating'] ?? '' ?>">
<textarea name="notes" placeholder="Notes"><?= $edit['notes'] ?? '' ?></textarea>

<?php if ($edit): ?>
    <input type="hidden" name="id" value="<?= $edit['id'] ?>">
    <button name="update">Update</button>
<?php else: ?>
    <button name="save">Save</button>
<?php endif; ?>
</form>

<hr>

<table border="1">
<tr><th>Player</th><th>Position</th><th>Rating</th><th>Notes</th><th>Action</th></tr>
<?php
$q = mysqli_query($conn, "SELECT * FROM scouting");
while ($row = mysqli_fetch_assoc($q)): ?>
<tr>
    <td><?= $row['player'] ?></td>
    <td><?= $row['position'] ?></td>
    <td><?= $row['rating'] ?></td>
    <td><?= $row['notes'] ?></td>
    <td>
        <a href="?edit=<?= $row['id'] ?>">Edit</a>
        <a href="?delete=<?= $row['id'] ?>">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
