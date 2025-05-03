<?php
require '../../include/connect.php';
$id = $_GET['id'];
$conn->query("UPDATE users SET status='active' WHERE id = $id");
header("Location: users");
exit();
