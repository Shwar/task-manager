<?php
include '../config/db.php';
include '../includes/auth.php';
include '../includes/functions.php';


if ($_SESSION['user']['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = (int)$_POST['task_id'];
    $new_status = sanitize($_POST['status']);
    
    $stmt = $conn->prepare("UPDATE tasks SET status=? WHERE id=? AND user_id=?");
    $stmt->bind_param("sii", $new_status, $task_id, $user_id);
    $stmt->execute();
}

// Fetch tasks
$result = $conn->query("SELECT * FROM tasks WHERE user_id = $user_id ORDER BY deadline ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?></h2>
    <p><a href="../logout.php">Logout</a></p>

    <h3>Your Tasks</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Update</th>
        </tr>
        <?php while($task = $result->fetch_assoc()): ?>
        <tr>
            <form method="POST">
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
