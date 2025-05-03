<?php
session_start();
ob_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

require '../../include/connect.php';
require '../../vendor/autoload.php';
require_once '../../mailer/send_welcome_email.php'; // mail logic
include_once '../../adminlayout/header.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_user'])) {
    $full_name = trim($_POST['full_name']);
    $number = trim($_POST['number']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $profile_image = $_FILES['profile_image']['name'];
    $target_dir = "../../uploads/";
    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_file = $target_dir . basename($profile_image);

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (full_name, number, address, profile_image, email, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $full_name, $number, $address, $profile_image, $email, $username, $hashed_password);

        if ($stmt->execute()) {
            $mailResult = sendWelcomeEmail($email, $full_name, $username, $password);
            $_SESSION['flash_message'] = $mailResult 
                ? "Registration successful! Welcome email has been sent." 
                : "Registration successful, but email failed to send.";

            header("Location: users.php");
            exit();
        } else {
            $message = "Failed to register user: " . $stmt->error;
        }
    } else {
        $message = "Failed to upload profile image.";
    }
}
?>

<!-- Optional alert display -->
<?php if (!empty($message)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	  <div class="container">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Register an Employee</h3>
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
						  <h4 class="box-title">Employee Registration</h4>
						</div>
						<!-- /.box-header -->
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="box-body">
								<h4 class="mt-0 mb-20">Contact Info:</h4>
								<div class="form-group">
									<label>Full Name:</label>
									<input  class="form-control"type="text" name="full_name" placeholder="Full Name" required>
								</div>
                                <div class="form-group">
									<label>Phone Number:</label>
									<input  class="form-control" type="tell"  name="number" placeholder="Phone Number" required>
								</div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea rows="5" cols="5" class="form-control" name="address" placeholder="Address" required></textarea>
                                </div>
                                <div class="form-group">
									<label>User Image:</label>
									<input type="file" name="profile_image" required class="form-control" >
								</div>
								<div class="form-group">
									<label>Email address:</label>
									<input type="email" class="form-control" name="email" placeholder="Email" required>
								</div>
                                <div class="form-group">
									<label>UserName:</label>
									<input  class="form-control" type="text" name="username" placeholder="Username" required>
								</div>
                                <div class="form-group">
									<label>Password</label>
									<input  class="form-control" type="password" name="password" placeholder="Password" required>
								</div>
								
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" name="register_user" class="btn btn-rounded btn-success pull-right">Register User</button>
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