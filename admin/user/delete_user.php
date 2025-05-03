<?php
require '../../include/connect.php';
$id = $_GET['id'];
$conn->query("DELETE FROM users WHERE id = $id");
header("Location: users"); // Replace with your actual user list page
exit();
