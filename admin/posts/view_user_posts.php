<?php
session_start();
ob_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Redirect to login if admin not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../adminlayout/header.php';

$sql = "SELECT posts.*, users.username FROM posts 
        LEFT JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC";

$result = mysqli_query($conn, $sql);
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
                         
                                <table class="table no-border">
                                    <thead>
                                        <tr class="text-uppercase bg-lightest">
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>User</th>
                                            <th>Date Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(mysqli_num_rows($result) > 0): ?>
                                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td class="pl-0 py-8">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 mr-20">
                                                        
                                                        
                                                         <?php if ($row['top_image']): ?>
                                                                <img class="bg-img h-50 w-50 rounded-circle" src="../../uploads/<?php echo $row['top_image']; ?>" >
                                                            <?php else: ?>
                                                                N/A
                                                            <?php endif; ?>
                                                     
                                                        
                                                    </div>

                                                    <div>
                                                        <a href="#" class="text-dark font-weight-600 hover-primary mb-1 font-size-16"><?php echo htmlspecialchars($row['title']); ?></a>
                            
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
                                                <?php echo ucfirst($row['status']); ?>
												</span>
                                            </td>
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                <?php echo $row['username']; ?>
												</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary-light badge-lg"><?php echo $row['created_at']; ?></span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="px-10 pt-5" href="#" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a  class="dropdown-item" href="view_post.php?id=<?php echo $row['id']; ?>">View Post</a> |
                                                        <a  class="dropdown-item" href="view_user.php?id=<?php echo $row['user_id']; ?>">View User</a> |
                                                        <a  class="dropdown-item" href="delete_post.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    
                                        <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr><td colspan="6">No posts found.</td></tr>
                                        <?php endif; ?>
                                        
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


<?php include_once '../../adminlayout/footer.php'; ?>
