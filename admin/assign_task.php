<?php
include '../config/db.php';
include '../includes/mail.php';
include '../includes/functions.php';

$users = $conn->query("SELECT id, name FROM users WHERE role = 'user'");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id']; 
    $title = sanitize($_POST['title']);
    $desc = sanitize($_POST['description']);
    $deadline = $_POST['deadline'];

    $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, deadline) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $title, $desc, $deadline);
    $stmt->execute();

    $emailResult = $conn->query("SELECT email FROM users WHERE id = $user_id");
    if ($emailResult->num_rows > 0) {
        $userEmail = $emailResult->fetch_assoc()['email'];
        $emailMsg = "<h3>New Task Assigned</h3>
            <p><strong>Title:</strong> $title<br>
            <strong>Description:</strong> $desc<br>
            <strong>Deadline:</strong> $deadline</p>";
        sendTaskEmail($userEmail, "New Task Assigned", $emailMsg);
    }

    echo "<p class='flash success'>Task assigned and email sent.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Task</title>
    <link rel="stylesheet" href="../style.css">
   
</head>
<body>
   <div class="form-container">
    <h2>Assign New Task</h2>
    <form method="post">
        <div class="form-group">
            <label for="user_id">Assign to:</label>
            <select name="user_id" id="user_id" required>
                <option value="">-- Select User --</option>
                <?php while ($u = $users->fetch_assoc()): ?>
                    <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline:</label>
            <input type="date" name="deadline" id="deadline" required>
        </div>

        <button type="submit">Assign Task</button>
    </form>
        <p><a href="dashboard.php">Back to Dashboard</a></p>

</div>

</body>
</html>
