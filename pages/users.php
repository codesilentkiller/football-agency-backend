<?php
session_start();
include "../config/db.php";

// Optional: Check if admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all users
$result = mysqli_query($conn, "SELECT id, name, email, created_at FROM users ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Users</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #111;
            color: #eee;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.6);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
            text-shadow: 1px 1px 3px #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #222;
            color: #fff;
            font-weight: 600;
        }

        tr {
            background-color: #1a1a1a;
            transition: background 0.2s;
        }

        tr:hover {
            background-color: #333;
            box-shadow: inset 0 0 10px #fff33;
        }

        a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            margin-right: 10px;
            transition: color 0.2s;
        }

        a:hover {
            color: #ffcc00;
        }

        .btn {
            padding: 6px 12px;
            background-color: #000;
            border: 1px solid #fff;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
        }

        .btn:hover {
            background-color: #111;
            box-shadow: 0 0 10px #fff55c33;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #333;
            background-color: #222;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Admin Dashboard - Users</h1>

    <div class="top-bar">
        <input type="text" class="search-input" placeholder="Search users..." id="searchBox">
        <a href="create_user.php" class="btn">Add New User</a>
    </div>

    <table id="usersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    // Simple search/filter functionality
    const searchBox = document.getElementById('searchBox');
    const table = document.getElementById('usersTable');
    searchBox.addEventListener('input', function() {
        const filter = searchBox.value.toLowerCase();
        const trs = table.getElementsByTagName('tr');
        for (let i = 1; i < trs.length; i++) {
            const tds = trs[i].getElementsByTagName('td');
            let show = false;
            for (let j = 0; j < tds.length - 1; j++) {
                if (tds[j].textContent.toLowerCase().includes(filter)) {
                    show = true;
                    break;
                }
            }
            trs[i].style.display = show ? '' : 'none';
        }
    });
</script>
</body>
</html>
