<?php
// admin/index.php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login");
    exit();
}

include_once __DIR__ . '/../include/connect.php';
include_once __DIR__ . '/../userlayout/header.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>



<div class="content-wrapper" style="min-height: 644px;">
    <div class="container">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Profile</h3>
                    
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">

            <div class="row">
               

                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-black" style="background: url('<?= $web_url ?>back/assets/images/gallery/full/10.jpg') center center;">
                            <h3 class="widget-user-username"><?= htmlspecialchars($user['full_name']) ?></h3>
                            <h6 class="widget-user-desc"><?= htmlspecialchars($user['username']) ?></h6>
                        </div>
                        <div class="widget-user-image">
                            <img  class="rounded-circle" src="../uploads/<?= htmlspecialchars($user['profile_image'] ?? 'default.png') ?>" alt="User Avatar">
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header"><?= htmlspecialchars($user['email']) ?></h5>
                                        <span class="description-text">Email</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 br-1 bl-1">
                                    <div class="description-block">
                                        <h5 class="description-header"><?= htmlspecialchars($user['number']) ?></h5>
                                        <span class="description-text">Number</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header"><?= htmlspecialchars($user['address']) ?></h5>
                                        <span class="description-text"><?= htmlspecialchars($user['status']) ?></span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    

                </div>

            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
</div>

<?php include_once __DIR__ . '/../userlayout/footer.php'; ?>
