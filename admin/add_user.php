<?php
include '../config/db.php';

function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    $role = sanitize($_POST['role']);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Add New User</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="password" placeholder="Password" required>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Add User</button>
    </form>
    <p><a href="dashboard.php">← Back to Dashboard</a></p>
</body>
</html>
