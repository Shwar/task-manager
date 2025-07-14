<?php
include '../config/db.php';
include '../includes/auth.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id = $id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $role = sanitize($_POST['role']);

    $stmt = $conn->prepare("UPDATE users SET username=?, email=?, role=? WHERE id=?");
    $stmt->bind_param("sssi", $username, $email, $role, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <input type="text" name="username" value="<?= $user['username'] ?>" required>
        <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <select name="role">
            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
        <button type="submit">Update</button>
    </form>
    <p><a href="dashboard.php">← Back to Dashboard</a></p>
</body>
</html>
