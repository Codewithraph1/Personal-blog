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
    die("No post ID provided.");
}

$id = intval($_GET['id']); // Sanitize ID

// Handle form submission
if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    // Handle image upload
    $image = $_FILES['image']['name'];
    if (!empty($image)) {
        $target = "../../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE admin_posts SET title='$title', content='$content', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE admin_posts SET title='$title', content='$content' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "Post updated!";
    } else {
        echo "Error updating post: " . mysqli_error($conn);
    }
}

// Fetch post data
$result = mysqli_query($conn, "SELECT * FROM admin_posts WHERE id=$id");
if (!$result || mysqli_num_rows($result) == 0) {
    die("Post not found.");
}

$post = mysqli_fetch_assoc($result);

?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	  <div class="container">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Edit Post</h3>
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
				<div class="col-lg-12 col-12">
					<!-- Basic Forms -->
					  <div class="box">
						<div class="box-header with-border">
						  <h4 class="box-title">Edit Post</h4>
                          
						</div>
						<!-- /.box-header -->
    
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="box-body">
								<h4 class="mt-0 mb-20">Post Info:</h4>
								<div class="form-group">
									<label>Post Title:</label>
									<input  class="form-control" type="text"name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
								</div>
                                <div class="form-group">
									<label>Highlight Image:</label>
                                    <?php if (!empty($post['image'])): ?>
                                        <img src="../../uploads/<?= htmlspecialchars($post['image']) ?>" width="150"><br>
                                    <?php endif; ?>
									<input type="file" name="image"  class="form-control" >
								</div>
                               
                                <div class="form-group">
                                    <label>Post Content</label>
                                    <textarea rows="20" cols="5" class="form-control" name="content"  required><?= htmlspecialchars($post['content']) ?></textarea>
                                </div>
                                
								
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" name="update" class="btn btn-rounded btn-success pull-right">Update  Post</button>
							</div>
						</form>
                       
					  </div>
					  <!-- /.box -->			
				</div>
		    </div>
		
		 

		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  


<?php

include_once __DIR__ . '/../../adminlayout/footer.php';

?>
