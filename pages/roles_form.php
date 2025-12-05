<?php
include "../config/db.php";
include "../models/roles.php";
$res = role_all($conn);
$msg = $_GET['msg'] ?? '';
?>
<!doctype html>
<html>
<head>
    <title>Roles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <?php if($msg): ?>
        <p class="success"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>

    <h2>Create Role</h2>

    <form method="POST" action="../controllers/roles_crud.php">
        <input type="hidden" name="action" value="create">

        <label>Role Name</label>
        <input name="name" required placeholder="Role name">

        <label>Description</label>
        <input name="description" placeholder="Description">

        <button>Create</button>
    </form>
</div>

<div class="container" style="max-width:800px;">
    <h2>All Roles</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        <?php while($r = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['name']) ?></td>
            <td><?= htmlspecialchars($r['description']) ?></td>
            <td>
                <form method="POST" action="../controllers/roles_crud.php" style="display:inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $r['id'] ?>">
                    <button onclick="return confirm('Delete role?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
