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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Handle image upload
    $profile_image = $_FILES['profile_image']['name'];
    $tmp_name = $_FILES['profile_image']['tmp_name'];
    if ($profile_image) {
        move_uploaded_file($tmp_name, "../uploads/$profile_image");
    }

    // Update query
    $query = "UPDATE admin_users SET username = ?, email = ?, " . ($password ? "password = ?, " : "") . ($profile_image ? "profile_image = ?" : "") . " WHERE id = ?";
    $params = [$username, $email];
    $types = "ss";
    if ($password) {
        $params[] = $password;
        $types .= "s";
    }
    if ($profile_image) {
        $params[] = $profile_image;
        $types .= "s";
    }
    $params[] = $admin_id;
    $types .= "i";

    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    echo "Profile updated!";
}

// Fetch current data
$stmt = $conn->prepare("SELECT * FROM admin_users WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	  <div class="container">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Admin Settings</h3>
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
						  <h4 class="box-title">Admin Settings</h4>
						</div>
						<!-- /.box-header -->
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="box-body">
								<h4 class="mt-0 mb-20">Contact Info:</h4>
								<div class="form-group">
									<label>User Name:</label>
									<input  class="form-control"type="text" name="username" value="<?= htmlspecialchars($admin['username']) ?>" required>
								</div>
                                <div class="form-group">
									<label>Email address:</label>
									<input type="email" class="form-control" name="email" value="<?= htmlspecialchars($admin['email']) ?>" required>
								</div>
                                <div class="form-group">
									<label>Admin Image:</label>
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
				</div>
		    </div>
		
		 

		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  










<?php include_once __DIR__ . '/../adminlayout/footer.php'; ?>