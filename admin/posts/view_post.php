<?php
session_start();
ob_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../adminlayout/header.php'; // Assuming header is in adminlayout

if (!isset($_GET['id'])) {
    echo "No post ID provided.";
    exit;
}

$post_id = intval($_GET['id']);

$sql = "SELECT posts.*, users.username FROM posts 
        LEFT JOIN users ON posts.user_id = users.id 
        WHERE posts.id = $post_id";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    echo "Post not found.";
    exit;
}
?>

<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Post Details</h3>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Post Details</h4>
                        </div>

                        <div class="box-body text-center py-4 px-4">
                            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                            <p><strong>Category:</strong> <?php echo $post['category']; ?></p>
                            <p><strong>Status:</strong> <?php echo ucfirst($post['status']); ?></p>
                            <p><strong>Posted by:</strong> <?php echo $post['username']; ?></p>
                            <p><strong>Posted on:</strong> <?php echo $post['created_at']; ?></p>
                            
                            <?php if ($post['top_image']): ?>
                                <img src="../../uploads/<?php echo $post['top_image']; ?>" height="300" width="500"><br>
                            <?php endif; ?>

                            <p><strong>Top Content:</strong><br><?php echo nl2br($post['top_content']); ?></p>

                            <?php if ($post['body_image']): ?>
                                <img src="../../uploads/<?php echo $post['body_image']; ?>"height="300" width="500"><br>
                            <?php endif; ?>

                            <p><strong>Content:</strong><br><?php echo nl2br($post['content']); ?></p>

                            <br><a href="view_user_posts.php">← Back to Posts</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include_once __DIR__ . '/../../adminlayout/footer.php'; ?>
