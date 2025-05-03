<?php

include_once __DIR__ . '/../include/connect.php';

$admin_id = $_SESSION['admin_id'];

$query = "SELECT * FROM admin_users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
  

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= $web_url ?>front/assets/img/favicon.ico" type="image/x-icon" />

    <title><?= $web_title ?>-<?= $web_name ?>-<?php echo $_SESSION['admin_username']; ?></title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?= $web_url ?>back/assets/css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="<?= $web_url ?>back/assets/css/style.css">
	<link rel="stylesheet" href="<?= $web_url ?>back/assets/css/skin_color.css">
     
  </head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">
	<div id="loader"></div>
  <header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-between">
		<a href="#" class="waves-effect waves-light nav-link rounded d-none d-md-inline-block mx-10 push-btn" data-toggle="push-menu" role="button">
			<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
		</a>	
		<!-- Logo -->
		<a href="index" class="logo">
		  <!-- logo-->
		  <div class="logo-lg">
			  <span class="light-logo"><img src="<?= $web_url ?>front/assets/img/adminlogo.png" alt="logo"></span>
			  
		  </div>
		</a>	
	</div>  
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-10">
		<div class="container">
		  <!-- Sidebar toggle button-->
		  <div class="app-menu">
			<ul class="header-megamenu nav">
				<li class="btn-group nav-item d-md-none">
					<a href="#" class="waves-effect waves-light nav-link rounded push-btn" data-toggle="push-menu" role="button">
						<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
					</a>
				</li>
				<li class="btn-group nav-item d-none d-xl-inline-block">
					<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded full-screen" title="Full Screen">
						<i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
					</a>
				</li>
			</ul> 
		  </div>

		  <div class="navbar-custom-menu r-side">
			<ul class="nav navbar-nav">		  
				<li class="btn-group d-lg-inline-flex d-none">
					<div class="app-menu">
						<div class="search-bx mx-5">
							<form>
								<div class="input-group">
								  <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
								  <div class="input-group-append">
									<button class="btn" type="submit" id="button-addon3"><i class="ti-search"></i></button>
								  </div>
								</div>
							</form>
						</div>
					</div>
				</li>
			  

			  <!-- User Account-->
			  <li class="dropdown user user-menu">
				<a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="User">
					<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
				</a>
				<ul class="dropdown-menu animated flipInX">
				  <li class="user-body">
					 <a class="dropdown-item" href="<?= $web_url ?>admin/admin_profile"><i class="ti-user text-muted mr-2"></i> Profile</a>
					 <a class="dropdown-item" href="<?= $web_url ?>admin/admin_settings"><i class="ti-settings text-muted mr-2"></i> Settings</a>
					 <div class="dropdown-divider"></div>
					 <a class="dropdown-item" href="<?= $web_url ?>admin/logout"><i class="ti-lock text-muted mr-2"></i> Logout</a>
				  </li>
				</ul>
			  </li>	

			  

			</ul>
		  </div>
		</div>
    </nav>
  </header>
  
  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
		<div class="user-profile px-20 py-15">
			<div class="d-flex align-items-center">			
				<h2><?php echo $_SESSION['admin_username']; ?></h2>
			</div>
			
        </div>
		<div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">
			  <!-- sidebar menu-->
			<ul class="sidebar-menu" data-widget="tree">		
			    <li class="treeview">
				  <a href="<?= $web_url ?>admin/index">
					<i  class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
					<span>Dashboard</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  
				</li>
				<li class="treeview">
				  <a href="#">
					<i  class="icon-User"><span class="path1"></span><span class="path2"></span></i>
					<span>Manage Users</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="<?= $web_url ?>admin/user/register_user"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add User</a></li>
					<li><a href="<?= $web_url ?>admin/user/users"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Users List</a></li>
					
				  </ul>
				</li>
		
				<li class="treeview">
				  <a href="#">
					<i  class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
					<span>Manage Post</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="<?= $web_url ?>admin/posts/postlist"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pending Post</a></li>
					<li><a href="<?= $web_url ?>admin/posts/view_user_posts"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Post List</a></li>
					
				  </ul>
				</li>	
				<li class="treeview">
				  <a href="#">
					<i  class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
					<span>Admin Post</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="<?= $web_url ?>admin/adminpost/create_post"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Create Post</a></li>
					<li><a href="<?= $web_url ?>admin/adminpost/view_posts"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Highlight List</a></li>
					
				  </ul>
				</li>
				<li class="treeview">
				  <a href="#">
					<i  class="icon-Book-open"><span class="path1"></span><span class="path2"></span></i>
					<span>Post Review</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="<?= $web_url ?>admin/postcheck/post_check"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Post Track</a></li>
					
				  </ul>
				</li>	
				<li class="treeview">
				  <a href="#">
					<i  class="icon-Incoming-mail"><span class="path1"></span><span class="path2"></span></i>
					<span>Support Ticket</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="<?= $web_url ?>admin/support/admin_support"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Post Track</a></li>
					
				  </ul>
				</li>
				 	     
			  </ul>
			</div>
		</div>
    </section>
  </aside>