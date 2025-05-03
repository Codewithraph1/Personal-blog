<?php

session_start();
ob_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}


require '../../include/connect.php';
include_once '../../adminlayout/header.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id = $id");
$user = $result->fetch_assoc();


if (isset($_POST['update_user'])) {
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $number = $conn->real_escape_string($_POST['number']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $address = $conn->real_escape_string($_POST['address']);
    $status = $_POST['status'];

    // Handle image upload
    if (!empty($_FILES['profile_image']['name'])) {
        $image_name = time() . '_' . $_FILES['profile_image']['name'];
        $image_tmp = $_FILES['profile_image']['tmp_name'];
        move_uploaded_file($image_tmp, "../../uploads/" . $image_name);

        $conn->query("UPDATE users SET 
            full_name='$full_name', 
            number='$number', 
            email='$email', 
            username='$username', 
            address='$address', 
            status='$status', 
            profile_image='$image_name' 
            WHERE id=$id
        ");
    } else {
        $conn->query("UPDATE users SET 
            full_name='$full_name', 
            number='$number', 
            email='$email', 
            username='$username', 
            address='$address', 
            status='$status' 
            WHERE id=$id
        ");
    }

    // Refresh to show updated data
    header("Location: view_user.php?id=$id");
    exit();
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
                                <img class="bg-img h-100 w-100 rounded-circle" src="../../uploads/<?= htmlspecialchars($user['profile_image']) ?>" alt="User Image">
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
                                    
                                </tbody>
                            </table>
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
         <!-- Main content -->
		<section class="content">
			<div class="row">			  
				<div class="col-lg-12 col-12">
					<!-- Basic Forms -->
					  <div class="box">
						<div class="box-header with-border">
						  <h4 class="box-title">Edit Employee info </h4>
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
									<label>Phone Number:</label>
									<input  class="form-control" type="tell"  name="number" value="<?= htmlspecialchars($user['number']) ?>"   required>
								</div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea rows="5" cols="5" class="form-control" name="address"  required><?= htmlspecialchars($user['address']) ?></textarea>
                                </div>
                                <div class="form-group">
									<<label>Change Profile Image (optional)</label>
									<input type="file" name="profile_image" class="form-control" >
								</div>
								<div class="form-group">
									<label>Email address:</label>
									<input type="email" class="form-control" name="email"  value="<?= htmlspecialchars($user['email']) ?>" required>
								</div>
                                <div class="form-group">
									<label>UserName:</label>
									<input  class="form-control" type="text" name="username"  value="<?= htmlspecialchars($user['username']) ?>" required>
								</div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="active" <?= $user['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="suspended" <?= $user['status'] == 'suspended' ? 'selected' : '' ?>>Suspended</option>
                                    </select>
                                </div>
                                
								
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit"name="update_user" class="btn btn-rounded btn-success pull-right">Update User</button>
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



<?php


include_once __DIR__ . '/../../adminlayout/footer.php';

?>
