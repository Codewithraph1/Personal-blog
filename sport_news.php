<?php
include_once 'include/connect.php';
include_once 'front/header.php';

$category = 'Sport News';

$query = $conn->prepare("SELECT * FROM posts WHERE category = ? AND status = 'published' ORDER BY created_at DESC");
$query->bind_param("s", $category);
$query->execute();
$result = $query->get_result();
?>

<div class="container main-wrapper">
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

    <div class="main-content mag-content clearfix">
        <div class="row main-body">
            <div class="col-md-12">
                <h3 class="block-title top-title"><span>Sport News</span></h3>
            </div>
        </div>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="col-md-4">
                    <article class="news-block small-block">
                        <a href="view-post.php?id=<?= $row['id'] ?>" class="overlay-link">
                            <figure class="image-overlay">
                                <img src="uploads/<?= htmlspecialchars($row['top_image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                            </figure>
                        </a>
                        <a href="#" class="category"><?= htmlspecialchars($row['category']) ?></a>
                        <header class="news-details">
                            <h3 class="news-title">
                                <a href="view-post.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a>
                            </h3>
                            <p class="simple-share">
                                by <a href="#"><b><?= $web_title ?> Team</b></a> -
                                <span class="article-date"><i class="fa fa-clock-o"></i> <?= date("F j, Y", strtotime($row['created_at'])) ?></span>
                            </p>
                        </header>
                    </article>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="load-more">
        <button type="button" class="btn btn-lg btn-block">Load more</button>
    </div>
</div>

<?php include_once 'front/footer.php'; ?>
