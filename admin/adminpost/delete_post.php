<?php
require '../../include/connect.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM admin_posts WHERE id=$id");
header("Location: view_posts");
?>
