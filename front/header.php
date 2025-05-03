<?php

include_once 'include/connect.php';


?>



<!doctype html>
<html>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8">
  <title><?= $web_title ?>-<?= $web_name ?></title>
  <meta name="keywords" content="HTML5 Template">
  <meta name="description" content="ADMAG — Responsive Blog & Magazine HTML Template">
  <meta name="author" content="digitaltheme.co">
  <meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= $web_url ?>front/assets/img/favicon.ico" type="image/x-icon" />
  <link rel="apple-touch-icon" sizes="57x57" href="<?= $web_url ?>front/assets/img/favicon.ico">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= $web_url ?>front/assets/img/favicon.ico">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= $web_url ?>front/assets/img/favicon.ico">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= $web_url ?>front/assets/img/favicon.ico">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= $web_url ?>front/assets/img/favicon.ico">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= $web_url ?>front/assets/img/favicon.ico">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= $web_url ?>front/assets/img/favicon.ico">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= $web_url ?>front/assets/img/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= $web_url ?>front/assets/img/favicon.ico">
  <link rel="icon" type="image/png" href="<?= $web_url ?>front/assets/img/favicon.ico" sizes="16x16">
  <link rel="icon" type="image/png" href="<?= $web_url ?>front/assets/img/favicon.ico" sizes="32x32">
  <link rel="icon" type="image/png" href="<?= $web_url ?>front/assets/img/favicon.ico" sizes="96x96">
  <link rel="icon" type="image/png" href="<?= $web_url ?>front/assets/img/favicon.ico" sizes="192x192">

  <!-- Google Fonts -->
  <link href="http://fonts.googleapis.com/css?family=Roboto:100,300,300italic,400,400italic,500,700,700italic,900" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Raleway:900" rel="stylesheet" type="text/css">

  <!-- Icon Font -->
  <link rel="stylesheet" href="front/assets/plugins/font-awesome/css/font-awesome.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="front/assets/plugins/bootstrap/css/bootstrap.min.css">

  <!-- Theme CSS -->
  <link rel="stylesheet" href="front/assets/css/style.min.css">
  

</head>
<body>
<div id="main" class="header-style1">
  
  <header class="header-wrapper clearfix">

    <div class="header" id="header">
      <div class="container">
        <div class="mag-content">
          <div class="row">
            <div class="col-md-12">
                          <!-- Mobile Menu Button -->
            <a class="navbar-toggle collapsed" id="nav-button" href="#mobile-nav">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a><!-- .navbar-toggle -->

            <!-- Main Nav Wrapper -->
            <nav class="navbar mega-menu">
              <a class="logo" href="index.html" title="" rel="home">
                CODE <span>WITHRAPH</span>
              </a><!-- .logo -->
              
              <!-- Navigation Menu -->
                          <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown menu-color1">
                  <a href="<?= $web_url ?>" class="dropdown-toggle" >Home</a>
                  
                </li><!-- .dropdown .menu-color1 -->

                <!-- Fullwith Mega Menu -->
                <li class="dropdown mega-full menu-color2">
                  <a href="headline_news" class="dropdown-toggle"  role="button" >Headline News</a>
                 
                </li><!-- .dropdown .mega-full .menu-color2 -->
                <li class="dropdown mega-full menu-color2">
                  <a href="latest_news" class="dropdown-toggle"  role="button" >Latest News</a>
                 
                </li>
                <!-- End Mega Menu -->
                 <!-- Dropdown List Menu -->
                <li class="dropdown menu-color1">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categories</a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-submenu">
                      <a href="sport_news">Sports News</a>
                    </li><!-- .dropdown-submenu -->

                 
                   
                    <li class="dropdown-submenu">
                      <a href="entertainment">Music/ Entertainment</a>
                      
                    </li><!-- .dropdown-submenu -->

                    <li class="dropdown-submenu">
                      <a href="social">Social</a>
                      
                    </li><!-- .dropdown-submenu -->

                    <li class="dropdown-submenu">
                      <a href="politics">Politics</a>
                     
                    </li><!-- .dropdown-submenu -->

                    <li><a href="business">Business</a></li>
                    
                  </ul><!-- dropdown-menu -->
                </li><!-- .dropdown .menu-color1 -->
                <li class="dropdown mega-full menu-color3">
                  <a href="contact" class="dropdown-toggle" >Contact</a>
                 
                </li>
                
               
                
              </ul><!-- .nav .navbar-nav -->
            </div><!-- .navbar-collapse -->              <!-- End Navigation Menu -->

              <div class="header-right">
                <div class="social-icons">
                  <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook fa-lg"></i></a>
                  <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter fa-lg"></i></a>
                  <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google+"><i class="fa fa-google-plus fa-lg"></i></a>
                  <!-- Only for Fixed Sidebar Layout -->
                  <a href="#" class="fixed-button navbar-toggle" id="fixed-button">
                    <i></i>
                    <i></i>
                    <i></i>
                    <i></i>
                  </a><!-- .fixed-button -->
                </div><!-- .social-icons -->
              </div><!-- .header-right -->

            </nav><!-- .navbar -->

            <div id="sb-search" class="sb-search">
              <form>
                <input class="sb-search-input" placeholder="Enter your search text..." type="text" value="" name="search" id="search">
                <input class="sb-search-submit" type="submit" value="">
                <span class="sb-icon-search fa fa-search" data-toggle="tooltip" data-placement="bottom" title="Search"></span>
              </form>
            </div><!-- .sb-search -->            </div>
          </div>
        </div><!-- .mag-content -->
      </div><!-- .container -->
    </div><!-- .header -->
    
  </header><!-- .header-wrapper -->