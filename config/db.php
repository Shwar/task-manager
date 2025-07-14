<?php

$host = 'localhost';
$db = 'task_management_system'; // Your DB name
$user = 'root';
$pass = 'don05@Simon'; // Database password - leave blank if none

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

 ?>
 