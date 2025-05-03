<?php

session_start();
ob_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../adminlayout/header.php';


$result = $conn->query("SELECT * FROM users");
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
                                Blog Employee List
                                <small class="subtitle">More than 400+ new members</small>
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <thead>
                                        <tr class="text-uppercase bg-lightest">
                                            <th >Full Name</span></th>
                                            <th >UserName</span></th>
                                            <th >Email</span></th>
                                            <th >Phone</span></th>
                                            <th>Status</span></th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 1; while ($user = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td class="pl-0 py-8">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 mr-20">
                                                        <h5><?= $count++ ?></h5>
                                                        <img class="bg-img h-50 w-50 rounded-circle" src="../../uploads/<?= htmlspecialchars($user['profile_image']) ?>" alt="User Image">

                                                     
                                                        
                                                    </div>

                                                    <div>
                                                        <a href="#" class="text-dark font-weight-600 hover-primary mb-1 font-size-16"><?= htmlspecialchars($user['full_name']) ?></a>
                                                        <span class="text-fade d-block"><?= htmlspecialchars($user['address']) ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                    
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?= htmlspecialchars($user['username']) ?>
												</span>
                                            </td>
                                            <td>
                                                
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?= htmlspecialchars($user['email']) ?>
												</span>
                                            </td>
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?= htmlspecialchars($user['number']) ?>
												</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary-light badge-lg"><?= htmlspecialchars($user['status']) ?></span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="px-10 pt-5" href="#" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="view_user.php?id=<?= $user['id'] ?>">👁 View User</a>
                                                        <a class="dropdown-item" href="change_password.php?id=<?= $user['id'] ?>">🔐 Change Password</a>
                                                        <?php if ($user['status'] === 'active'): ?>
                                                            <a class="dropdown-item text-warning" href="suspend_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Suspend this user?')">🚫 Suspend User</a>
                                                        <?php else: ?>
                                                            <a class="dropdown-item text-success" href="activate_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Activate this user?')">✅ Activate User</a>
                                                        <?php endif; ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger" href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">🗑 Delete User</a>
                                                    </div>
                                                </div>
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


include_once __DIR__ . '/../../adminlayout/footer.php';

?>
