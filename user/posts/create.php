<?php
session_start();
ob_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require '../../include/connect.php';
include_once '../../userlayout/header.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $top_content = $_POST['top_content'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in

    // Handle image uploads
    $top_image = $_FILES['top_image']['name'];
    $body_image = $_FILES['body_image']['name'];

    $top_image_tmp = $_FILES['top_image']['tmp_name'];
    $body_image_tmp = $_FILES['body_image']['tmp_name'];

    // Generate unique names for the images to avoid overwriting
    $top_image_new_name = time() . '_' . $top_image;
    $body_image_new_name = time() . '_' . $body_image;

    // Move uploaded images to the upload directory
    move_uploaded_file($top_image_tmp, "../../uploads/$top_image_new_name");
    move_uploaded_file($body_image_tmp, "../../uploads/$body_image_new_name");

    // Insert post data into database
    $sql = "INSERT INTO posts (title, top_content, content, top_image, body_image, category, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $title, $top_content, $content, $top_image_new_name, $body_image_new_name, $category, $user_id);

    if ($stmt->execute()) {
        echo "Post submitted and awaiting admin approval.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Create Post</h3>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Create Post</h4>
                        </div>

                        <form action="create" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <h4 class="mt-0 mb-20">Post Info:</h4>

                                <div class="form-group">
                                    <label>Post Title:</label>
                                    <input class="form-control" type="text" name="title" placeholder="Post Title" required>
                                </div>

                                <div class="form-group">
                                    <label>Top Content:</label>
                                    <input class="form-control" type="text" name="top_content" placeholder="Top Content" required>
                                </div>

                                <div class="form-group">
                                    <label>Top Image:</label>
                                    <input type="file" name="top_image" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Body Image:</label>
                                    <input type="file" name="body_image" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Post Content:</label>
                                    <textarea rows="10" class="form-control" name="content" placeholder="Post Content" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Category:</label>
                                    <select name="category" class="form-control" required>
                                        <option value="Latest News">Latest News</option>
                                        <option value="Headline News">Headline News</option>
                                        <option value="Sport News">Sport News</option>
                                        <option value="Music/ Entertainment">Music/ Entertainment</option>
                                        <option value="Social News">Social News</option>
                                        <option value="Politics">Politics</option>
                                        <option value="Business">Business</option>
                                    </select>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" name="submit" class="btn btn-rounded btn-success pull-right">Submit Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include_once __DIR__ . '/../../userlayout/footer.php'; ?>
