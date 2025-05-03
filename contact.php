<?php
  include_once 'include/connect.php';
  include_once 'front/header.php';
?>


<!-- Parallax Header -->
<div class="parallax-header page-wrapper">

  <!-- Parallax image -->
  <div class="parallax-image" id="parallax-image" data-stellar-ratio="0.5" data-image="front/assets/img/page.jpg">
  </div>

  <!-- Post title and meta -->
  <div class="parallax-wrapper">
    <div class="container">
      <div class="mag-content parallax-box">
        <div class="row">
          <div class="col-md-12 parallax-box">
            <header class="page-header">
              <h1 class="page-title">
                Contact Us
              </h1><!-- .post-title -->

              <p class="page-description">
                Don't act so surprised, Your Highness. You weren't on any mercy mission this time. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you.
              </p>
            </header><!-- .post-header -->
          </div><!-- .col-md-12 -->
        </div><!-- .row -->
      </div>
    </div><!-- .container -->
    
  </div><!-- .parallax-wrapper -->
</div><!-- .parallax-header -->

<!-- Post body -->
<div class="container">
  <div class="main-content mag-content clearfix">
    <div class="row">
      <div class="col-md-12">

        <article class="post-wrapper">

          <div class="post-content clearfix">
            <div id="map-canvas"></div>

            <div class="row">
              <div class="col-md-6">

                  <form class="clearfix" action="#" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" name="name" id="name" value="" tabindex="1" class="form-control" placeholder="Name *">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="email" id="email" value="" tabindex="2" class="form-control" placeholder="Email *">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="message" cols="50" rows="6" tabindex="4" class="form-control" placeholder="Your message *"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                      <button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="btn btn-default">Submit</button>
                      </div>
                    </div>
                  </form>

              </div>

              <div class="col-md-6">
                <p>
                  <strong>Address:</strong><br/>
                  <?= $web_address ?> <br/>
                  <strong>Phone:</strong> <?= $web_number ?> <br/>
                 
                  <strong>Email:</strong> <?= $web_email ?>
                </p>
                <ul class="social-list clearfix">

                  <li class="social-facebook">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facebook">
                      <i class="fa fa-facebook"></i>
                    </a>
                  </li>
                  <li class="social-twitter" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Twitter">
                    <a href="#">
                      <i class="fa fa-twitter"></i>
                    </a>
                  </li>
                  <li class="social-gplus">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Google+">
                      <i class="fa fa-google-plus"></i>
                    </a>
                  </li>
                  <li class="social-youtube">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Youtube">
                      <i class="fa fa-youtube"></i>
                    </a>
                  </li>
                  <li class="social-instagram">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Instagram">
                      <i class="fa fa-instagram"></i>
                    </a>
                  </li>
                  <li class="social-pinterest">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pinterest">
                      <i class="fa fa-pinterest"></i>
                    </a>
                  </li>
                  <li class="social-rss">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="RSS">
                      <i class="fa fa-rss"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div><!-- .post-content -->

        </article><!-- .post-wrapper -->

      </div><!-- .col-md-12 -->

    </div><!-- .row -->
    
  </div><!-- .main-content -->

</div><!-- .container -->



<?php 

   include_once 'front/footer.php';
?>

