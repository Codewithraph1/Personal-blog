<?php
session_start();
ob_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../adminlayout/header.php';

$result = mysqli_query($conn, "SELECT * FROM admin_posts ORDER BY created_at DESC");
$count = 1;
?>

<div class="content-wrapper" style="min-height: 644px;">
    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title align-items-start flex-column">
                                Admin Highlights
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <thead>
                                        <tr class="text-uppercase bg-lightest">
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($post = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td class="pl-0 py-8">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 mr-20">
                                                        <h5><?= $count++ ?></h5>
                                                        <img class="bg-img h-50 w-50 rounded-circle" src="../../uploads/<?= htmlspecialchars($post['image']) ?>" alt="Post Image">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?= htmlspecialchars($post['title']) ?>
                                                </span>
                                            </td>
                                           
                                            <td>
                                                <span class="text-dark font-weight-600 d-block font-size-16">
                                                    <?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="px-10 pt-5" href="#" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="edit_post.php?id=<?= $post['id'] ?>">Edit</a>
                                                        <a class="dropdown-item" href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Delete this post?')">Delete</a>
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
    </div>
</div>

<?php include_once __DIR__ . '/../../adminlayout/footer.php'; ?>
