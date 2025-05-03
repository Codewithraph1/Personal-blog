<?php
session_start();
ob_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../adminlayout/header.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Upload image
    $image = $_FILES['image']['name'];
    $target = "../../uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Insert into database
    $sql = "INSERT INTO admin_posts (title, image, content) VALUES ('$title', '$image', '$content')";
    mysqli_query($conn, $sql);

    echo "Post created successfully!";
}


?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	  <div class="container">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Create Post</h3>
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
						  <h4 class="box-title">Create Post</h4>
                          
						</div>
						<!-- /.box-header -->
    
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="box-body">
								<h4 class="mt-0 mb-20">Post Info:</h4>
								<div class="form-group">
									<label>Post Title:</label>
									<input  class="form-control" type="text"name="title" placeholder="Post Title" required>
								</div>
                                <div class="form-group">
									<label>Highlight Image:</label>
									<input type="file" name="image" required  class="form-control" >
								</div>
                               
                                <div class="form-group">
                                    <label>Post Content</label>
                                    <textarea rows="20" cols="5" class="form-control" name="content" placeholder="Post Content" required></textarea>
                                </div>
                                
								
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" name="submit" class="btn btn-rounded btn-success pull-right">Create Post</button>
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
