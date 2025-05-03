<?php
session_start();
ob_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../adminlayout/header.php'; 

// Handle Post Approval or Decline
if (isset($_GET['action']) && isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $action = $_GET['action']; // Can be 'approve' or 'decline'

    // Sanitize the action value
    if ($action == 'approve') {
        $status = 'published';
    } elseif ($action == 'decline') {
        $status = 'declined';
    }

    // Update the post status in the database
    $sql = "UPDATE posts SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $post_id);

    if ($stmt->execute()) {
        echo "Post status updated to $status.";
    } else {
        echo "Error updating post status: " . $stmt->error;
    }
}

// Fetch all pending posts
$sql = "SELECT p.id, p.title,p.top_image, p.category, p.status, p.created_at, u.username
        FROM posts p
        JOIN users u ON p.user_id = u.id
        WHERE p.status = 'pending'";
$result = $conn->query($sql);
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
                                Pending Posts
                                
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                            <?php if ($result->num_rows > 0): ?>
                                <table class="table no-border">
                                    <thead>
                                        <tr class="text-uppercase bg-lightest">
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td class="pl-0 py-8">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 mr-20">
                                                        <h5><?php echo $row['id']; ?></h5>
                                                        <img class="bg-img h-50 w-50 rounded-circle" src="../../uploads/<?php echo $row['top_image']; ?>" alt="User Image">

                                                     
                                                        
                                                    </div>

                                                    <div>
                                                        <a href="#" class="text-dark font-weight-600 hover-primary mb-1 font-size-16"><?php echo $row['title']; ?></a>
                            
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                    
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?php echo $row['category']; ?>
												</span>
                                            </td>
                                            <td>
                                                
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?php echo $row['username']; ?>
												</span>
                                            </td>
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?php echo $row['created_at']; ?>
												</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary-light badge-lg"><?php echo $row['status']; ?></span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="px-10 pt-5" href="#" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="?action=approve&post_id=<?php echo $row['id']; ?>" class="dropdown-item">Approve</a>
                                                        <a href="?action=decline&post_id=<?php echo $row['id']; ?>" class="dropdown-item">Decline</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    
                                        <?php endwhile; ?>
                                        
                                    </tbody>
                                </table>
                                <?php else: ?>
                                <p>No pending posts.</p>
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


<?php include_once '../../adminlayout/footer.php'; ?>
