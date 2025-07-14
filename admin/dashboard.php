<?php
include '../config/db.php';
include '../includes/auth.php';

if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$users = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2, h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .actions {
            text-align: center;
            margin-bottom: 25px;
        }

        .actions a {
            display: inline-block;
            margin: 5px 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .actions a:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f7f7f7;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .edit-btn, .delete-btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }

        .edit-btn {
            background-color: #28a745;
            color: #fff;
        }

        .edit-btn:hover {
            background-color: #218838;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>

        <div class="actions">
            <a href="add_user.php">Add New User</a>
            <a href="assign_task.php">Assign Task</a>
            <a href="tasks.php">View Tasks</a>
            <a href="../logout.php">Logout</a>
        </div>

        <h3>User List</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $users->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= ucfirst($row['role']) ?></td>
                <td>
                    <a class="edit-btn" href="edit_user.php?id=<?= $row['id'] ?>">Edit</a>
                    <a class="delete-btn" href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
