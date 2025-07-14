<?php
include '../config/db.php';
include '../includes/auth.php';

if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Update status if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = (int)$_POST['task_id'];
    $status = sanitize($_POST['status']);

    $stmt = $conn->prepare("UPDATE tasks SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $task_id);
    $stmt->execute();
}

// Fetch all tasks with user info
$sql = "
    SELECT tasks.*, users.name 
    FROM tasks 
    JOIN users ON tasks.user_id = users.id
    ORDER BY tasks.deadline ASC
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Tasks - Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>All Tasks Overview</h2>
    <p><a href="dashboard.php">Back to Dashboard</a></p>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Assigned To</th>
            <th>Title</th>
            <th>Description</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Update</th>
        </tr>
        <?php while ($task = $result->fetch_assoc()): ?>
        <tr>
            <form method="POST">
                <td><?= htmlspecialchars($task['name']) ?></td>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['description']) ?></td>
                <td><?= htmlspecialchars($task['deadline']) ?></td>
                <td>
                    <select name="status">
                        <option value="Pending" <?= $task['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="In Progress" <?= $task['status'] === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                        <option value="Completed" <?= $task['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                    <button type="submit">Update</button>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
