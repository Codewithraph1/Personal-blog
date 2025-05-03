<?php
// admin/login.php
session_start();
include_once __DIR__ . '/../include/connect.php';

$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();

        if ($user['status'] !== 'active') {
            $login_error = "Account is suspended. Contact support.";
        } elseif (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: index");
            exit();
        } else {
            $login_error = "Invalid username or password.";
        }
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://powerbi-admin-template.multipurposethemes.com/bs4/images/favicon.ico">

    <title>Managment access- Log in </title>
  
    <!-- Vendors Style-->
    <link rel="stylesheet" href="http://localhost/blog/back/assets/css/vendors_css.css">
	  
    <!-- Style-->  
    <link rel="stylesheet" href="http://localhost/blog/back/assets/css/style.css">
    <link rel="stylesheet" href="http://localhost/blog/back/assets/css/skin_color.css">

</head>
	
<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-1.jpg)">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded30 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">Let's Get Started</h2>
								<p class="mb-0">Login as a employee.</p>							
							</div>
							<div class="p-40">
							<?php if ($login_error): ?>
								<div class="alert alert-danger"><?= $login_error ?></div>
							<?php endif; ?>
								<form action="" method="post">
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											</div>
											<input type="text" name="username" class="form-control pl-15 bg-transparent" placeholder="Username" required>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
											</div>
											<input type="password" name="password" class="form-control pl-15 bg-transparent" placeholder="Password" required >
										</div>
									</div>
									  <div class="row">
										<div class="col-6">
										  <div class="checkbox">
											<input type="checkbox" id="basic_checkbox_1" >
											<label for="basic_checkbox_1">Remember Me</label>
										  </div>
										</div>
										<div class="col-12 text-center">
										  <button type="submit"  class="btn btn-danger mt-10">SIGN IN</button>
										</div>
										<!-- /.col -->
									  </div>
								</form>		
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<!-- Vendor JS -->
    <script src="http://localhost/blog/back/assets/js/vendors.min.js"></script>
    <script src="http://localhost/blog/back/assets/icons/feather-icons/feather.min.js"></script>	

	

</body>

</html>
