<?php
  include_once 'include/connect.php';
  include_once 'front/header.php';

  // Fetch posts from admin_posts
$query = "SELECT * FROM admin_posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

$posts = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
}


?>


<div id="main" class="header-style1">

   
    <!-- Begin Main Wrapper -->
    <div class="container main-wrapper">

        <!-- End Main Banner -->
        <div class="mag-content clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div class="ad728-wrapper">
                      <a href="#">
                        <img src="front/assets/img/CODEWITHRAPH.png" alt="">
                      </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Banner -->
        <div class="main-content mag-content clearfix">

        <div class="row featured-wrapper">
          <div class="col-md-12">
              <div class="flexslider">
                  <div class="flex-viewport" style="overflow: hidden; position: relative;">
                      <div class="featured-slider" style="width: 100%;">
                          <?php foreach ($posts as $post): ?>
                              <div class="slider-item" style="width: 100%; float: left; display: block;">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="featured-big">
                                              <a href="#" class="featured-href">
                                                  <img src="uploads/<?= htmlspecialchars($post['image']) ?>" alt="" draggable="false">
                                                  <div class="featured-header">
                                                      <span class="category bgcolor2">Highlights of Today</span>
                                                      <h2><?= htmlspecialchars($post['title']) ?></h2>
                                                      <p class="simple-share">
                                                          <span class="article-date"><?= date("F j, Y, g:i a", strtotime($post['created_at'])) ?></span>
                                                      </p>
                                                      <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                                                  </div>
                                              </a>
                                          </div>
                                      </div>
                                  </div> <!-- .row -->
                              </div> <!-- .slider-item -->
                          <?php endforeach; ?>
                      </div> <!-- .featured-slider -->
                  </div> <!-- .flex-viewport -->
                  <ul class="flex-direction-nav">
                      <li class="flex-nav-prev"><a class="flex-prev" href="#"><i class="fa fa-angle-left"></i></a></li>
                      <li class="flex-nav-next"><a class="flex-next" href="#"><i class="fa fa-angle-right"></i></a></li>
                  </ul>
              </div> <!-- .flexslider -->
          </div>
      </div>


            <!-- .featured-wrapper -->
            <div class="row main-body" data-stickyparent="" style="position: relative;">
                <div class="col-md-8">
                    
                    <!-- BEGIN BLOCK 2 -->
                    <section class="news-text-block">
                        <div class="row">
                          <div class="col-md-12">
                            <?php
                            $latest = $conn->prepare("SELECT * FROM posts WHERE category = 'Latest News' AND status = 'published' ORDER BY created_at DESC LIMIT 5");
                            $latest->execute();
                            $latest_result = $latest->get_result();
                            if ($latest_result->num_rows > 0):
                            ?>
                                <h3 class="block-title"><span><a href="latest_news">Latest News</a></span></h3>
                                <?php while ($row = $latest_result->fetch_assoc()): ?>
                                    <article class="news-block big-block">
                                        <a href="view-post.php?id=<?= $row['id'] ?>" class="overlay-link">
                                            <figure class="image-overlay">
                                                <?php if ($row['top_image']): ?>
                                                    <img src="uploads/<?= $row['top_image'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                                                <?php endif; ?>
                                            </figure>
                                        </a>
                                        <a href="#" class="category"><?= htmlspecialchars($row['category']) ?></a>
                                        <header class="news-details">
                                            <h3 class="news-title">
                                                <a href="view-post.php?id=<?= $row['id'] ?>">
                                                    <?= htmlspecialchars($row['title']) ?>
                                                </a>
                                            </h3>
                                            <p><?= substr(strip_tags($row['top_content']), 0, 100) ?>...</p>
                                            <p class="simple-share">
                                                by <a href="#"><b><?= $web_title ?> Team</b></a> -
                                                <span class="article-date">
                                                    <i class="fa fa-clock-o"></i> <?= date('F j, Y', strtotime($row['created_at'])) ?>
                                                </span>
                                            </p>
                                        </header>
                                    </article>
                                <?php endwhile; ?>
                            <?php endif; ?>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <?php
                              $headline = $conn->prepare("SELECT * FROM posts WHERE category = 'Headline News' AND status = 'published' ORDER BY created_at DESC LIMIT 5");
                              $headline->execute();
                              $headline_result = $headline->get_result();
                              if ($headline_result->num_rows > 0):
                              ?>
                                <h3 class="block-title"><span><a href="headline_news">Headline News</a></span></h3>
                                <?php while ($row = $headline_result->fetch_assoc()): ?>
                                    <article class="news-block big-block">
                                        <a href="view-post.php?id=<?= $row['id'] ?>" class="overlay-link">
                                            <figure class="image-overlay">
                                                <?php if ($row['top_image']): ?>
                                                    <img src="uploads/<?= $row['top_image'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                                                <?php endif; ?>
                                            </figure>
                                        </a>
                                        <a href="#" class="category"><?= htmlspecialchars($row['category']) ?></a>
                                        <header class="news-details">
                                            <h3 class="news-title">
                                                <a href="view-post.php?id=<?= $row['id'] ?>">
                                                    <?= htmlspecialchars($row['title']) ?>
                                                </a>
                                            </h3>
                                            <p><?= substr(strip_tags($row['top_content']), 0, 100) ?>...</p>
                                            <p class="simple-share">
                                                 <a href="#"><b></b><?= $web_title ?> Team</a> -
                                                <span class="article-date">
                                                    <i class="fa fa-clock-o"></i> <?= date('F j, Y', strtotime($row['created_at'])) ?>
                                                </span>
                                            </p>
                                        </header>
                                    </article>
                                <?php endwhile; ?>
                            <?php endif; ?>
                          </div>
                        </div>

                        <div class="row">
                          <h3 class="block-title"><span><a href="sport_news">Sports News</a></span></h3>
                          <?php
                            $sport = $conn->prepare("SELECT * FROM posts WHERE category = 'Sport News' AND status = 'published' ORDER BY created_at DESC LIMIT 5");
                            $sport->execute();
                            $sport_result = $sport->get_result();
                            if ($sport_result->num_rows > 0):
                            ?>
                            <?php while ($row = $sport_result->fetch_assoc()): ?>
                            <div class="col-md-6">
                              
                            
                                <article class="news-block small-block">
                                    <a href="sport_news" class="overlay-link">
                                        <figure class="image-overlay">
                                        <?php if ($row['top_image']): ?>
                                            <img src="uploads/<?= $row['top_image'] ?>" alt="<?= $row['title'] ?>">
                                        <?php endif; ?>
                                        </figure>
                                    </a>
                                    <a href="#" class="category">
                                    <?= htmlspecialchars($row['title']) ?>
                                    </a>
                                    <header class="news-details">
                                        <h3 class="news-title">
                                          <a href="#">
                                          <?= substr(strip_tags($row['top_content']), 0, 100) ?>...
                                          </a>
                                        </h3>
                                        <p class="simple-share">
                                        <a href="view-post.php?id=<?= $row['id'] ?>">Read More</a>
                                            <span class="article-date"><i class="fa fa-clock-o"></i> <?= date('F j, Y', strtotime($row['created_at'])) ?></span>
                                        </p>
                                    </header>
                                </article>
                               
                            </div>
                            <?php endwhile; ?>
                              <!-- News block -->
                              <?php endif; ?>
                            
                        </div>

                        <div class="row">
                            <h3 class="block-title"><span><a href="entertainment">Music / Entertainment</a></span></h3>
                            <?php
                            $music = $conn->prepare("SELECT * FROM posts WHERE category = 'Music/ Entertainment' AND status = 'published' ORDER BY created_at DESC LIMIT 5");
                            $music->execute();
                            $music_result = $music->get_result();
                            if ($music_result->num_rows > 0):
                                while ($row = $music_result->fetch_assoc()):
                            ?>
                                <div class="col-md-6">
                                    <article class="news-block small-block">
                                        <a href="music_entertainment" class="overlay-link">
                                            <figure class="image-overlay">
                                                <?php if ($row['top_image']): ?>
                                                <img src="uploads/<?= $row['top_image'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                                                <?php endif; ?>
                                            </figure>
                                        </a>
                                        <a href="#" class="category">
                                            <?= htmlspecialchars($row['title']) ?>
                                        </a>
                                        <header class="news-details">
                                            <h3 class="news-title">
                                                <a href="#">
                                                    <?= substr(strip_tags($row['top_content']), 0, 100) ?>...</a>
                                            </h3>
                                            <p class="simple-share">
                                                <a href="view-post.php?id=<?= $row['id'] ?>">Read More</a>
                                                <span class="article-date"><i class="fa fa-clock-o"></i> <?= date('F j, Y', strtotime($row['created_at'])) ?></span>
                                            </p>
                                        </header>
                                    </article>
                                </div>
                                <?php endwhile; endif; ?>
                        </div>
                        <div class="row">
                          <h3 class="block-title"><span><a href="social">Social News</a></span></h3>
                          <?php
                          $social = $conn->prepare("SELECT * FROM posts WHERE category = 'Social News' AND status = 'published' ORDER BY created_at DESC LIMIT 5");
                          $social->execute();
                          $social_result = $social->get_result();
                          if ($social_result->num_rows > 0):
                              while ($row = $social_result->fetch_assoc()):
                          ?>
                              <div class="col-md-6">
                                  <article class="news-block small-block">
                                      <a href="social_news" class="overlay-link">
                                          <figure class="image-overlay">
                                              <?php if ($row['top_image']): ?>
                                              <img src="uploads/<?= $row['top_image'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                                              <?php endif; ?>
                                          </figure>
                                      </a>
                                      <a href="#" class="category">
                                          <?= htmlspecialchars($row['title']) ?>
                                      </a>
                                      <header class="news-details">
                                          <h3 class="news-title">
                                              <a href="#">
                                                  <?= substr(strip_tags($row['top_content']), 0, 100) ?>...</a>
                                          </h3>
                                          <p class="simple-share">
                                              <a href="view-post.php?id=<?= $row['id'] ?>">Read More</a>
                                              <span class="article-date"><i class="fa fa-clock-o"></i> <?= date('F j, Y', strtotime($row['created_at'])) ?></span>
                                          </p>
                                      </header>
                                  </article>
                              </div>
                              <?php endwhile; endif; ?>
                      </div>
                      <div class="row">
                          <h3 class="block-title"><span><a href="politics">Politics</a></span></h3>
                          <?php
                          $politics = $conn->prepare("SELECT * FROM posts WHERE category = 'Politics' AND status = 'published' ORDER BY created_at DESC LIMIT 5");
                          $politics->execute();
                          $politics_result = $politics->get_result();
                          if ($politics_result->num_rows > 0):
                              while ($row = $politics_result->fetch_assoc()):
                          ?>
                              <div class="col-md-6">
                                  <article class="news-block small-block">
                                      <a href="politics_news" class="overlay-link">
                                          <figure class="image-overlay">
                                              <?php if ($row['top_image']): ?>
                                              <img src="uploads/<?= $row['top_image'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                                              <?php endif; ?>
                                          </figure>
                                      </a>
                                      <a href="#" class="category">
                                          <?= htmlspecialchars($row['title']) ?>
                                      </a>
                                      <header class="news-details">
                                          <h3 class="news-title">
                                              <a href="#">
                                                  <?= substr(strip_tags($row['top_content']), 0, 100) ?>...</a>
                                          </h3>
                                          <p class="simple-share">
                                              <a href="view-post.php?id=<?= $row['id'] ?>">Read More</a>
                                              <span class="article-date"><i class="fa fa-clock-o"></i> <?= date('F j, Y', strtotime($row['created_at'])) ?></span>
                                          </p>
                                      </header>
                                  </article>
                              </div>
                              <?php endwhile; endif; ?>
                      </div>
                      <div class="row">
                        <h3 class="block-title"><span><a href="business">Business</a></span></h3>
                        <?php
                        $business = $conn->prepare("SELECT * FROM posts WHERE category = 'Business' AND status = 'published' ORDER BY created_at DESC LIMIT 5");
                        $business->execute();
                        $business_result = $business->get_result();
                        if ($business_result->num_rows > 0):
                            while ($row = $business_result->fetch_assoc()):
                        ?>
                            <div class="col-md-6">
                                <article class="news-block small-block">
                                    <a href="business_news" class="overlay-link">
                                        <figure class="image-overlay">
                                            <?php if ($row['top_image']): ?>
                                            <img src="uploads/<?= $row['top_image'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                                            <?php endif; ?>
                                        </figure>
                                    </a>
                                    <a href="#" class="category">
                                        <?= htmlspecialchars($row['title']) ?>
                                    </a>
                                    <header class="news-details">
                                        <h3 class="news-title">
                                            <a href="#">
                                                <?= substr(strip_tags($row['top_content']), 0, 100) ?>...</a>
                                        </h3>
                                        <p class="simple-share">
                                            <a href="view-post.php?id=<?= $row['id'] ?>">Read More</a>
                                            <span class="article-date"><i class="fa fa-clock-o"></i> <?= date('F j, Y', strtotime($row['created_at'])) ?></span>
                                        </p>
                                    </header>
                                </article>
                            </div>
                            <?php endwhile; endif; ?>
                    </div>
                    </section>
                    <!-- END BLOCK 2 -->

                </div>
                <!-- End Left big column -->

                <div class="col-md-4" data-stickycolumn="" style="">
                  <aside class="sidebar clearfix">

                        <div class="widget adwidget">
                            <a href="#"><img src="img/ban300.jpg" alt=""></a>
                        </div>

                        <div class="widget searchwidget">
                            <form class="searchwidget-form">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="widget tagwidget">
                            <h3 class="block-title"><span>Tags</span></h3>
                            <ul class="tags-widget">
                              <li><a href="#">Football</a></li>
                              <li><a href="#">Basketball</a></li>
                              <li><a href="#">Pop Music</a></li>
                              <li><a href="#">Hip-Hop</a></li>
                              <li><a href="#">Elections</a></li>
                              <li><a href="#">Trending News</a></li>
                              <li><a href="#">Startups</a></li>
                              <li><a href="#">Tech Business</a></li>
                              <li><a href="#">Social Media</a></li>
                              <li><a href="#">Politics Today</a></li>
                              <li><a href="#">Economy</a></li>
                          </ul>

                        </div>

                        <div class="widget reviewwidget">
                          <?php
                          $reviewQuery = "SELECT * FROM admin_posts ORDER BY created_at DESC LIMIT 4";
                          $reviewResult = mysqli_query($conn, $reviewQuery);
                          
                          $reviews = [];
                          if ($reviewResult && mysqli_num_rows($reviewResult) > 0) {
                              while ($row = mysqli_fetch_assoc($reviewResult)) {
                                  $reviews[] = $row;
                              }
                          }
                          
                          ?>
                          <h3 class="block-title"><span>Reviews</span></h3>

                          <?php foreach ($reviews as $review): ?>
                              <article class="widget-post clearfix">
                                  <div class="simple-thumb">
                                      <a href="#">
                                          <img src="uploads/<?= htmlspecialchars($review['image']) ?>" alt="" style="width:70px; height:70px; object-fit:cover;">
                                      </a>
                                  </div>
                                  <header>
                                      <h3>
                                          <a href="#"><?= htmlspecialchars($review['title']) ?></a>
                                      </h3>
                                      <p class="simple-share">
                                          <span class="star-reviews">
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star"></i>
                                              <i class="fa fa-star-o"></i>
                                          </span>
                                      </p>
                                  </header>
                              </article>
                          <?php endforeach; ?>
                      </div>

                        <!-- End review widget -->

                        <div class="widget categorywidget">
                            <h3 class="block-title"><span>Categories</span></h3>
                            <ul>
                              <li>
                                  <a href="#">Sports News <span class="count"><i class="fa fa-star"></i></span></a>
                              </li>
                              <li>
                                  <a href="#">Music / Entertainment <span class="count"><i class="fa fa-star"></i></span></a>
                              </li>
                              <li>
                                  <a href="#">Social New <span class="count"><i class="fa fa-star"></i></span></a>
                              </li>
                              <li>
                                  <a href="#">Politics <span class="count"><i class="fa fa-star"></i></span></a>
                              </li>
                              <li>
                                  <a href="#">Bussiness <span class="count"><i class="fa fa-star"></i></span></a>
                              </li>
                            </ul>
                        </div>

                        <div class="widget adwidget subscribewidget">
                            <h3 class="block-title"><span>Subscribe</span></h3>
                            <p>The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>
                            <form class="form-inline">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter your email">
                                    <span class="input-group-btn">
                                  <button class="btn btn-default" type="button">Subscribe</button>
                                </span>
                                </div>
                            </form>
                        </div>

                    </aside>
                </div>
                <!-- End last column -->
            </div>
            <!-- .main-body -->
        </div>
        <!-- .main-content -->

       
    </div>
    <!-- .main-wrapper -->

   

</div>



<?php 

   include_once 'front/footer.php';
?>

