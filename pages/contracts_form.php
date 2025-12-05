<?php
include "../config/db.php";

if (isset($_POST['save'])) {
    mysqli_query($conn, "INSERT INTO contracts (player, club, start_date, end_date, salary)
    VALUES ('{$_POST['player']}', '{$_POST['club']}', '{$_POST['start_date']}', '{$_POST['end_date']}', '{$_POST['salary']}')");
}

if (isset($_GET['delete'])) {
    mysqli_query($conn, "DELETE FROM contracts WHERE id=".$_GET['delete']);
}

$edit = null;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM contracts WHERE id=".$_GET['edit']));
}

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE contracts SET 
        player='{$_POST['player']}',
        club='{$_POST['club']}',
        start_date='{$_POST['start_date']}',
        end_date='{$_POST['end_date']}',
        salary='{$_POST['salary']}'
    WHERE id={$_POST['id']}");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contracts Management</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #111;
        color: #eee;
        margin: 40px;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        text-shadow: 0 0 10px #fff;
    }

    form {
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 8px;
        max-width: 600px;
        margin: 0 auto 30px auto;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
    }

    form input, form button {
        display: block;
        width: 100%;
        padding: 12px 10px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        font-size: 16px;
    }

    form input {
        background-color: #222;
        color: #eee;
    }

    form input::placeholder {
        color: #aaa;
    }

    form button {
        background-color: #000;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 0 5px #fff;
    }

    form button:hover {
        background-color: #111;
        box-shadow: 0 0 15px #fff;
    }

    hr {
        margin: 40px 0;
        border: 0;
        border-top: 1px solid #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        max-width: 900px;
        margin: 0 auto;
    }

    table th, table td {
        padding: 12px 15px;
        text-align: left;
    }

    table th {
        background-color: #222;
        color: #fff;
        text-shadow: 0 0 5px #fff;
    }

    table tr:nth-child(even) {
        background-color: #1a1a1a;
    }

    table tr:hover {
        background-color: #333;
    }

    table a {
        color: #fff;
        text-decoration: none;
        margin-right: 10px;
        transition: 0.3s;
    }

    table a:hover {
        color: #00f;
        text-shadow: 0 0 5px #00f;
    }
</style>
</head>
<body>

<h1>⚽ Contracts Management</h1>

<form method="post">
    <input name="player" value="<?= $edit['player'] ?? '' ?>" placeholder="Player" required>
    <input name="club" value="<?= $edit['club'] ?? '' ?>" placeholder="Club" required>
    <input type="date" name="start_date" value="<?= $edit['start_date'] ?? '' ?>" required>
    <input type="date" name="end_date" value="<?= $edit['end_date'] ?? '' ?>" required>
    <input name="salary" placeholder="Salary" value="<?= $edit['salary'] ?? '' ?>" required>

    <?php if ($edit): ?>
        <input type="hidden" name="id" value="<?= $edit['id'] ?>">
        <button name="update">Update Contract</button>
    <?php else: ?>
        <button name="save">Save Contract</button>
    <?php endif; ?>
</form>

<hr>

<table>
<tr><th>Player</th><th>Club</th><th>Start</th><th>End</th><th>Salary</th><th>Action</th></tr>
<?php
$q = mysqli_query($conn, "SELECT * FROM contracts");
while ($row = mysqli_fetch_assoc($q)): ?>
<tr>
    <td><?= htmlspecialchars($row['player']) ?></td>
    <td><?= htmlspecialchars($row['club']) ?></td>
    <td><?= htmlspecialchars($row['start_date']) ?></td>
    <td><?= htmlspecialchars($row['end_date']) ?></td>
    <td><?= htmlspecialchars($row['salary']) ?></td>
    <td>
        <a href="?edit=<?= $row['id'] ?>">Edit</a>
        <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete contract?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>
