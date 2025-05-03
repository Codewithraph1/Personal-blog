<?php

session_start();
ob_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}


require '../../include/connect.php';
include_once '../../adminlayout/header.php';


if (!isset($_GET['id'])) {
    echo "No user ID provided.";
    exit;
}

$user_id = intval($_GET['id']);
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found.";
    exit;
}

?>



<div class="content-wrapper" style="min-height: 644px;">
    <div class="container">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Employee Details</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page"><?= $web_title ?></li>
								<li class="breadcrumb-item active" aria-current="page">-<?= $web_name ?></li>
							</ol>
						</nav>
                    </div>
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title"><?= htmlspecialchars($user['full_name']) ?></h4>
                            <br>
                            <div class="align-items-right">
                                <?php if ($user['profile_image']): ?>
                                    <img src="../../uploads/<?= $user['profile_image'] ?>" class="bg-img h-100 w-100 rounded-circle">
                                <?php endif; ?>
                               
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table style="clear: both" class="table table-bordered table-striped" id="user">
                                <tbody>
                                    <tr>
                                        <td width="35%">Username</td>
                                        <td width="65%"> <?= htmlspecialchars($user['username']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email Address</td>
                                        <td>
                                        <?= htmlspecialchars($user['email']) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td>
                                        <?= htmlspecialchars($user['number']) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><?= htmlspecialchars($user['status']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Employed date</td>
                                        <td>
                                        <?= htmlspecialchars($user['created_at']) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><?= htmlspecialchars($user['address']) ?></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <a href="view_user_posts" class="btn btn-secondary mt-3">Back to List</a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.col -->

        </section>
        <!-- /.content -->
       
    </div>
</div>



<?php


include_once __DIR__ . '/../../adminlayout/footer.php';

?>
