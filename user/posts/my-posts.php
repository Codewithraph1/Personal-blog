<?php
session_start();
ob_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../userlayout/header.php'; // Assuming header is in userlayout

$user_id = $_SESSION['user_id'];

// Fetch user's posts
$sql = "SELECT id, title, category, status, created_at FROM posts WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>




<div class="content-wrapper" style="min-height: 644px;">
    <div class="container">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              
                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title align-items-start flex-column">
                                My Posts    
                               
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                            <?php if ($result->num_rows > 0): ?>
                                <table class="table no-border">
                                    <thead>
                                        <tr class="text-uppercase bg-lightest">
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                    
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?php echo $row['id']; ?>
                                                </span>
                                            </td>
                                            <td>
                    
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?php echo $row['title']; ?>
												</span>
                                            </td>
                                            <td>
                                                
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?php echo $row['category']; ?>
												</span>
                                            </td>
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?php echo $row['status']; ?>
												</span>
                                            </td>
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?php echo $row['created_at']; ?>
												</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="px-10 pt-5" href="#" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="view_post.php?post_id=<?php echo $row['id']; ?>">👁 View Post</a>
                                                       
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php endwhile; ?>

                                    </tbody>
                                </table>
                                <?php else: ?>
                                <p>You have no posts.</p>
                            <?php endif; ?>
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


include_once __DIR__ . '/../../userlayout/footer.php';

?>
