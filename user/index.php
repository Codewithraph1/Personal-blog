<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
include_once __DIR__ . '/../include/connect.php';
include_once __DIR__ . '/../userlayout/header.php';

// Count total posts
$total_posts = $conn->query("SELECT COUNT(*) as total FROM posts")->fetch_assoc()['total'];
$published = $conn->query("SELECT COUNT(*) as total FROM posts WHERE status = 'published'")->fetch_assoc()['total'];
$pending = $conn->query("SELECT COUNT(*) as total FROM posts WHERE status = 'pending'")->fetch_assoc()['total'];
$declined = $conn->query("SELECT COUNT(*) as total FROM posts WHERE status = 'declined'")->fetch_assoc()['total'];

?>




<div class="content-wrapper" style="min-height: 644px;">
    <div class="container">
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
                <div class="col-xl-3">
                    <a href="#" class="box">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-dark font-weight-700 h2 mb-2 mt-5"><?= $total_posts ?></div>
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
                                    <div class="text-dark font-weight-700 h2 mb-2 mt-5"><?= $published ?></div>
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
                                    <div class="text-dark font-weight-700 h2 mb-2 mt-5"><?= $pending ?></div>
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
                                    <div class="text-dark font-weight-700 h2 mb-2 mt-5"><?= $declined ?></div>
                                    <div class="font-size-16">Decline</div>
                                </div>
                                <div class="bg-success-light rounded-circle h-80 w-80 text-center l-h-100">
                                    <span class="icon-Mail text-success font-size-40"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>








<?php


include_once __DIR__ . '/../userlayout/footer.php';

?>