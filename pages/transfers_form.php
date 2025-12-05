<?php
include "../config/db.php";

// Fetch all transfers
$q = mysqli_query($conn, "
    SELECT 
        t.id,
        t.fee,
        u1.name AS player_name,
        c1.club_name AS from_club,
        c2.club_name AS to_club
    FROM transfers t
    LEFT JOIN users u1 ON u1.id = t.player_id
    LEFT JOIN club_profiles c1 ON c1.id = t.old_club_id
    LEFT JOIN club_profiles c2 ON c2.id = t.new_club_id
    ORDER BY t.created_at DESC
");

// If editing, fetch the transfer
$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM transfers WHERE id=$id LIMIT 1");
    $edit = mysqli_fetch_assoc($res);
}
?>
<!doctype html>
<html>
<head>
    <title>Transfers</title>
    <style>
        /* (Use the same CSS from your previous styling block) */
        body { font-family: 'Segoe UI', sans-serif; background: #111; color: #eee; }
        .container { max-width: 900px; margin: 40px auto; background: #1a1a1a; padding: 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.6); }
        h2 { text-align: center; margin-bottom: 30px; color: #fff; text-shadow: 1px 1px 3px #000; }
        form { display: grid; grid-template-columns: 1fr 1fr; gap: 20px 30px; margin-bottom: 40px; }
        label { grid-column: span 2; font-weight: 600; color: #ccc; }
        input { grid-column: span 2; padding: 12px 15px; border-radius: 8px; border: 1px solid #333; background-color: #222; color: #fff; transition: all 0.2s ease-in-out; }
        input:focus { border-color: #fff; box-shadow: 0 0 10px #fff55c33; outline: none; }
        button { grid-column: span 2; padding: 12px; background-color: #000; color: #fff; font-weight: bold; border: 1px solid #fff; border-radius: 10px; cursor: pointer; transition: all 0.2s ease-in-out; box-shadow: 0 0 5px #fff33, 0 0 15px #fff22 inset; }
        button:hover { background-color: #111; box-shadow: 0 0 20px #fff, 0 0 30px #fff inset; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px 15px; text-align: left; }
        th { background-color: #222; color: #fff; font-weight: 600; }
        tr { background-color: #1a1a1a; transition: background 0.2s; }
        tr:hover { background-color: #333; box-shadow: inset 0 0 10px #fff33; }
        a { color: #fff; text-decoration: none; font-weight: 600; margin-right: 10px; transition: color 0.2s; }
        a:hover { color: #ffcc00; }
        hr { border: 0; border-top: 1px solid #444; margin: 30px 0; }
        @media (max-width: 600px) { form { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<div class="container">
    <h2>Transfers</h2>

    <form method="post" action="../controllers/transfers_crud.php">
        <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
        <input type="hidden" name="action" value="<?= $edit ? 'update' : 'create' ?>">

        <label>Player name</label>
        <input type="text" name="player_name" required value="<?= htmlspecialchars($edit['player_name'] ?? '') ?>">

        <label>From club</label>
        <input type="text" name="from_club" value="<?= htmlspecialchars($edit['from_club'] ?? '') ?>">

        <label>To club</label>
        <input type="text" name="to_club" value="<?= htmlspecialchars($edit['to_club'] ?? '') ?>">

        <label>Transfer fee</label>
        <input type="number" name="fee" step="0.01" value="<?= htmlspecialchars($edit['fee'] ?? '') ?>">

        <button type="submit"><?= $edit ? 'Update' : 'Save' ?></button>
        <?php if($edit): ?>
            <a href="transfers_form.php" style="color:#ffcc00; text-align:center; display:block; margin-top:10px;">Cancel</a>
        <?php endif; ?>
    </form>

    <hr>

    <table>
        <tr>
            <th>Player</th>
            <th>From</th>
            <th>To</th>
            <th>Fee</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($q)): ?>
            <tr>
                <td><?= htmlspecialchars($row['player_name'] ?? '') ?></td>
                <td><?= htmlspecialchars($row['from_club'] ?? '') ?></td>
                <td><?= htmlspecialchars($row['to_club'] ?? '') ?></td>
                <td><?= htmlspecialchars($row['fee'] ?? '0') ?></td>
                <td>
                    <a href="?edit=<?= $row['id'] ?>">Edit</a>
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete transfer?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
