<?php
require '../../include/connect.php';
$id = $_GET['id'];
$conn->query("UPDATE users SET status='suspended' WHERE id = $id");
header("Location: users");
exit();
