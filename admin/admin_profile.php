<?php
// admin/index.php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login");
    exit();
}

include_once __DIR__ . '/../include/connect.php';
include_once __DIR__ . '/../adminlayout/header.php';

$admin_id = $_SESSION['admin_id'];

$query = "SELECT * FROM admin_users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
?>



<div class="content-wrapper" style="min-height: 644px;">
    <div class="container">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Profile</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Extra</li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-12 col-lg-7 col-xl-8">

                   
                </div>
                <!-- /.col -->

                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-black" style="background: url('<?= $web_url ?>back/assets/images/gallery/full/10.jpg') center center;">
                            <h3 class="widget-user-username"><?= htmlspecialchars($admin['username']) ?></h3>
                            <h6 class="widget-user-desc">Admin</h6>
                        </div>
                        <div class="widget-user-image">
                            <img  class="rounded-circle" src="../uploads/<?= htmlspecialchars($admin['profile_image']) ?>" alt="User Avatar">
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header"> <?= htmlspecialchars($admin['email']) ?></h5>
                                        <span class="description-text">Email</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 br-1 bl-1">
                                    <div class="description-block">
                                        <h5 class="description-header"><?= htmlspecialchars($admin['username']) ?></h5>
                                        <span class="description-text">UserName</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header"><?= $web_title ?></h5>
                                        <span class="description-text"><?= $web_name ?></span>
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

<?php include_once __DIR__ . '/../adminlayout/footer.php'; ?>
