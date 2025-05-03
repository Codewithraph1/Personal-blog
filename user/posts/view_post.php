<?php
session_start();
ob_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../userlayout/header.php';
if (!isset($_GET['post_id'])) {
    echo "No post selected.";
    exit();
}

$post_id = $_GET['post_id'];
$user_id = $_SESSION['user_id'];

// Fetch the post (only if it belongs to this user)
$sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $post_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Post not found.";
    exit();
}

$post = $result->fetch_assoc();

?>





<div class="content-wrapper">
    <div class="container">
        <div class="content-header"><h3 class="page-title">View Post</h3></div>
        <div class="box">
            <div class="box-body">
                <h4><?php echo htmlspecialchars($post['title']); ?></h4>
                <p><strong>Category:</strong> <?php echo $post['category']; ?></p>
                <p><strong>Status:</strong> <?php echo $post['status']; ?></p>
                <p><?php echo nl2br($post['content']); ?></p>

                <?php if ($post['top_image']): ?>
                    <img src="../../uploads/<?php echo $post['top_image']; ?>" style="max-width: 100%; height: auto;" />
                <?php endif; ?>

                <?php if ($post['body_image']): ?>
                    <img src="../../uploads/<?php echo $post['body_image']; ?>" style="max-width: 100%; height: auto;" />
                <?php endif; ?>
            </div>
        </div>
    </div>
  <!-- /.content-wrapper -->
  


<?php

include_once __DIR__ . '/../../userlayout/footer.php';

?>
