<?php
require '../../include/connect.php';

if (!isset($_GET['id'])) {
    echo "No post ID provided.";
    exit;
}

$post_id = intval($_GET['id']);

// Optional: fetch image paths to delete them too
$sql = "SELECT top_image, body_image FROM posts WHERE id = $post_id";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

// Delete images if they exist
if ($post) {
    if ($post['top_image'] && file_exists("../../uploads/" . $post['top_image'])) {
        unlink("../../uploads/" . $post['top_image']);
    }
    if ($post['body_image'] && file_exists("../../uploads/" . $post['body_image'])) {
        unlink("../../uploads/" . $post['body_image']);
    }
}

// Delete post
$delete = "DELETE FROM posts WHERE id = $post_id";
if (mysqli_query($conn, $delete)) {
    header("Location: view_user_posts.php?deleted=1");
    exit;
} else {
    echo "Error deleting post.";
}
?>
