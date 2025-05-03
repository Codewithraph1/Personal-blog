<?php
session_start();
ob_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../adminlayout/header.php';

// Fetch all users
$userQuery = "SELECT * FROM users ORDER BY full_name ASC";
$userResult = $conn->query($userQuery);
?>

<div class="content-wrapper" style="min-height: 644px;">
    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title align-items-start flex-column">
                                Post Check
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <thead>
                                        <tr class="text-uppercase bg-lightest">
                                            <th>User</th>
                                            <th>Total Posts</th>
                                            <th>Published</th>
                                            <th>Pending</th>
                                            <th>Declined</th>
                                            <th>Total Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($user = $userResult->fetch_assoc()) :
                                            $userId = $user['id'];

                                            // Get posts count
                                            $postStats = $conn->query("
                                                SELECT 
                                                    COUNT(*) AS total_posts,
                                                    SUM(status = 'published') AS published,
                                                    SUM(status = 'pending') AS pending,
                                                    SUM(status = 'declined') AS declined
                                                FROM posts 
                                                WHERE user_id = $userId
                                            ")->fetch_assoc();

                                            // Get total comments on user's posts
                                            $commentQuery = $conn->query("
                                                SELECT COUNT(*) AS total_comments 
                                                FROM comments 
                                                WHERE post_id IN (
                                                    SELECT id FROM posts WHERE user_id = $userId
                                                )
                                            ");
                                            $totalComments = $commentQuery->fetch_assoc()['total_comments'];
                                        ?>
                                        <tr>
                                            
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                <?= htmlspecialchars($user['full_name']) ?>
                                                </span>
                                            </td>
                                           
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                <?= $postStats['total_posts'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                        <?= $postStats['published'] ?>
                                                </span>
                                            </td>
                                           
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                <?= $postStats['pending'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                <?= $postStats['declined'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                <?= $totalComments ?>
                                                </span>
                                            </td>
                                           
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include_once __DIR__ . '/../../adminlayout/footer.php'; ?>
