<?php
// admin/index.php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login");
    exit();
}

include_once __DIR__ . '/../include/connect.php';
include_once __DIR__ . '/../adminlayout/header.php';


// Get total posts
$totalPosts = $conn->query("SELECT COUNT(*) AS count FROM posts")->fetch_assoc()['count'];

// Get total comments
$totalComments = $conn->query("SELECT COUNT(*) AS count FROM comments")->fetch_assoc()['count'];

// Get post statuses
$totalPublished = $conn->query("SELECT COUNT(*) AS count FROM posts WHERE status = 'published'")->fetch_assoc()['count'];
$totalPending = $conn->query("SELECT COUNT(*) AS count FROM posts WHERE status = 'pending'")->fetch_assoc()['count'];
$totalDeclined = $conn->query("SELECT COUNT(*) AS count FROM posts WHERE status = 'declined'")->fetch_assoc()['count'];


// Fetch all users
$userQuery = "SELECT * FROM users ORDER BY full_name ASC";
$userResult = $conn->query($userQuery);

?>



<div class="content-wrapper" style="min-height: 644px;">
    <div class="container">
        <!-- Main content -->
        <section class="content">
            <div class="row">
               
                <div class="col-xl-3">
                    <a href="#" class="box">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-dark font-weight-700 h2 mb-2 mt-5"><?= $totalPosts ?></div>
                                    <div class="font-size-16">Total Posts</div>
                                </div>
                                <div class="bg-danger-light rounded-circle h-80 w-80 text-center l-h-100">
                                    <span class="text-danger font-size-40 icon-Cart2"><span class="path1"></span><span class="path2"></span></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3">
                    <a href="#" class="box">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-dark font-weight-700 h2 mb-2 mt-5"><?= $totalPublished ?></div>
                                    <div class="font-size-16">Published Posts</div>
                                </div>
                                <div class="bg-warning-light rounded-circle h-80 w-80 text-center l-h-100">
                                    <span class="text-warning font-size-40 icon-Binocular"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3">
                    <a href="#" class="box">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-dark font-weight-700 h2 mb-2 mt-5"><?= $totalPending ?></div>
                                    <div class="font-size-16">Pending Posts</div>
                                </div>
                                <div class="bg-success-light rounded-circle h-80 w-80 text-center l-h-100">
                                    <span class="icon-Mail text-success font-size-40"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3">
                    <a href="#" class="box">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-dark font-weight-700 h2 mb-2 mt-5"><?= $totalComments ?></div>
                                    <div class="font-size-16">Total Comments</div>
                                </div>
                                <div class="bg-success-light rounded-circle h-80 w-80 text-center l-h-100">
                                    <span class="icon-Mail text-success font-size-40"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
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
        <!-- /.content -->
    </div>
</div>






<?php


include_once __DIR__ . '/../adminlayout/footer.php';

?>