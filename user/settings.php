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

// Fetch current data
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$success = "";
$error = "";

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Image upload
    $profile_image = $user['profile_image'];
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name']) {
        $target_dir = "uploads/";
        $filename = basename($_FILES["profile_image"]["name"]);
        $target_file = $target_dir . time() . "_" . $filename;
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
        $profile_image = $target_file;
    }

    $update = $conn->prepare("UPDATE users SET full_name=?, number=?, address=?, email=?, username=?, profile_image=? WHERE id=?");
    $update->bind_param("ssssssi", $full_name, $number, $address, $email, $username, $profile_image, $user_id);
    
    if ($update->execute()) {
        $success = "Profile updated successfully!";
    } else {
        $error = "Update failed!";
    }
}

// Handle password change
if (isset($_POST['old_password'], $_POST['new_password'])) {
    $old = $_POST['old_password'];
    $new = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    if (password_verify($old, $user['password'])) {
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param("si", $new, $user_id);
        $stmt->execute();
        $success = "Password changed!";
    } else {
        $error = "Old password incorrect.";
    }
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	  <div class="container">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Profile Settings</h3>
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
						  <h4 class="box-title">Profile Settings</h4>
						</div>
						<!-- /.box-header -->
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="box-body">
								<h4 class="mt-0 mb-20">Contact Info:</h4>
                                <div class="form-group">
									<label>Full Name:</label>
									<input  class="form-control"type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
								</div>
								<div class="form-group">
									<label>User Name:</label>
									<input  class="form-control"type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
								</div>
                                <div class="form-group">
									<label>Email address:</label>
									<input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
								</div>
                                <div class="form-group">
									<label>Address:</label>
									<input  class="form-control"type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>
								</div>
                                <div class="form-group">
									<label>Profile Image:</label>
									<input type="file" name="profile_image" required class="form-control" >
								</div>
                                <div class="form-group">
									<label>New Password</label>
									<input  class="form-control" type="password" name="password" placeholder="Password" >
								</div>
								
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit"  class="btn btn-rounded btn-success pull-right">Update</button>
							</div>
						</form>
                       
					</div>
					  <!-- /.box -->	
                       
                      <div class="box">
						<div class="box-header with-border">
						  <h4 class="box-title">Change Password</h4>
						</div>
						<!-- /.box-header -->
						<form method="POST" >
							<div class="box-body">
								<h4 class="mt-0 mb-20">Change Password</h4>
                                
                                <div class="form-group">
									<label>Old Password</label>
									<input  class="form-control" type="password" name="old_password" placeholder="Old Password"required>
								</div>
                                <div class="form-group">
									<label>New Password</label>
									<input  class="form-control" type="password" name="new_password" placeholder="New Password" required>
								</div>
								
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit"  class="btn btn-rounded btn-success pull-right">Update</button>
							</div>
						</form>
                       
					</div>
				</div>
		    </div>
		
		 

		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  










<?php include_once __DIR__ . '/../userlayout/footer.php'; ?>