<?php
include_once 'include/connect.php';
include_once 'front/header.php';

if (!isset($_GET['id'])) {
    echo "Invalid post ID.";
    exit;
}

$id = intval($_GET['id']);
$query = $conn->prepare("SELECT * FROM posts WHERE id = ? AND status = 'published'");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo "Post not found.";
    exit;
}

$post = $result->fetch_assoc();

// Prevent multiple form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && !isset($_SESSION['comment_submitted'])) {
    $name = trim($_POST['author']);
    $email = trim($_POST['email']); // optional use
    $comment = trim($_POST['comment']);
    $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : null;

    // Simple email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.');</script>";
    }

    if (!empty($name) && !empty($comment)) {
        // Sanitize user input to prevent XSS attacks
        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
        
        // Insert comment into the database
        $stmt = $conn->prepare("INSERT INTO comments (post_id, parent_id, name, email, comment) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $id, $parent_id, $name, $email, $comment);
        if ($stmt->execute()) {
            $_SESSION['comment_submitted'] = true; // Set session flag to prevent multiple submissions
            echo "<script>alert('Comment submitted!'); window.location.href = 'view-post.php?id=" . $id . "';</script>";
        } else {
            echo "<script>alert('Failed to submit comment.');</script>";
        }
    } else {
        echo "<script>alert('Name and comment are required.');</script>";
    }
}

// Reset the flag on page load (so new comments can be submitted)
if (!isset($_SESSION['comment_submitted'])) {
    unset($_SESSION['comment_submitted']);
}
?>

<div class="container main-wrapper">
    <div class="mag-content clearfix">
        <div class="row">
            <div class="col-md-12">
                <div class="ad728-wrapper">
                    <a href="#">
                        <img src="front/assets/img/CODEWITHRAPH.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content mag-content clearfix">
        <div class="row blog-content">
            <div class="col-md-12 post-wrapper fullwidth-header">
                <header class="post-header">
                    <h1 class="post-title"><?= htmlspecialchars($post['title']) ?></h1>
                    <a href="#" class="category bgcolor2"><?= htmlspecialchars($post['category']) ?></a>
                    <p class="simple-share">
                        <span>by <a href="#"><b><?= $web_title ?> Team</b></a></span>
                        <span class="article-date"><i class="fa fa-clock-o"></i><?= date('F j, Y \a\t g:i A', strtotime($post['created_at'])) ?></span>
                        <span><i class="fa fa-eye"></i> 1349 views</span>
                        <a class="comments-count" href="#comments">4</a>
                    </p>

                    <figure class="image-overlay">
                        <?php if ($post['top_image']): ?>
                            <img src="uploads/<?= htmlspecialchars($post['top_image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
                        <?php endif; ?>
                    </figure>
                </header>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <article class="post-wrapper clearfix">
                    <div class="post-content clearfix">
                        <?php if (!empty($post['top_content'])): ?>
                            <h3><?= nl2br(htmlspecialchars($post['top_content'])) ?></h3>
                        <?php endif; ?>
                        <div class="wp-caption alignright">
                            <a href="uploads/<?= htmlspecialchars($post['body_image']) ?>" class="popup-image">
                                <?php if ($post['body_image']): ?>
                                    <img src="uploads/<?= htmlspecialchars($post['body_image']) ?>" alt="Body Image">
                                <?php endif; ?>
                            </a>
                        </div>
                        <p><?= nl2br($post['content']) ?></p>
                    </div>

                    <!-- Comment List -->
                    <div id="comments" class="comments-wrapper clearfix">
                        <h3 class="block-title"><span>Comments</span></h3>

                        <ol class="comment-list">
                            <?php
                            // Function to fetch comments (with recursion)
                            function fetch_comments($conn, $post_id, $parent_id = null, $level = 0) {
                                $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? AND parent_id " . ($parent_id === null ? "IS NULL" : "= ?") . " ORDER BY created_at ASC");
                                if ($parent_id === null) {
                                    $stmt->bind_param("i", $post_id);
                                } else {
                                    $stmt->bind_param("ii", $post_id, $parent_id);
                                }
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($comment = $result->fetch_assoc()) {
                                    ?>
                                    <li class="depth-<?php echo $level + 1; ?>">
                                        <div class="comment-body">
                                            <div class="comment-meta">
                                                <div class="comment-author vcard">
                                                     <div class="comment-metadata">
                                                        <p class="fn">
                                                            <span class="author-name"><?php echo htmlspecialchars($comment['name']); ?></span>
                                                            <span class="time"><?php echo date("F j, Y, g:i a", strtotime($comment['created_at'])); ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-content">
                                                <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                                            </div>
                                            <div class="reply">
                                                <a href="#respond" class="comment-reply-link" data-comment-id="<?php echo $comment['id']; ?>">Reply</a>
                                            </div>
                                        </div>

                                        <?php
                                        // Recursive call to fetch children
                                        echo '<ol class="children">';
                                        fetch_comments($conn, $post_id, $comment['id'], $level + 1);
                                        echo '</ol>';
                                        ?>
                                    </li>
                                    <?php
                                }
                            }
                            ?>

                            <ol class="comment-list">
                                <?php fetch_comments($conn, $id); ?>
                            </ol>

                        </ol>
                    </div>

                    <!-- Comment form -->
                    <div id="respond" class="comment-form clearfix">
                        <h3 class="comment-title">Leave a Comment</h3>
                        <form class="clearfix" action="" method="post" id="commentform">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="author" id="author" value="" tabindex="1" class="form-control" placeholder="Name *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" value="" tabindex="2" class="form-control" placeholder="Email *">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="comment" cols="50" rows="6" tabindex="4" class="form-control" placeholder="Your comment *"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

<?php 
   include_once 'front/footer.php';
?>
