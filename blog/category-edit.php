<?php
session_start();
require 'connection.php';

// LOGIN CHECK
if (!isset($_SESSION['isLogin']) == true) {
    header("Location: login.php");
    exit;
}

// CHECK ID
if (!isset($_GET['id'])) {
    header("Location: category-list.php");
    exit;
}

$id = $_GET['id'];

// FETCH CATEGORY DATA
$sql = "SELECT * FROM categories WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result->num_rows == 0) {
    header("Location: category-list.php");
    exit;
}

$category = mysqli_fetch_assoc($result);

// FORM SUBMIT
if (isset($_POST['update'])) {

    $name  = trim($_POST['name']);
    $slug  = trim($_POST['slug']);
    $image = $_FILES['image'];

    // VALIDATION
    if (empty($name)) {
        $message = "Name is required";
        $messageType = "danger";
    } elseif (empty($slug)) {
        $message = "Slug is required";
        $messageType = "danger";
    } else {

        // Escape values
        $name = mysqli_real_escape_string($conn, $name);
        $slug = mysqli_real_escape_string($conn, $slug);

        // IMAGE NOT SELECTED
        if ($image['error'] == 4) {

            // UPDATE WITHOUT IMAGE
            $updateSql = "UPDATE categories SET 
                            name = '$name',
                            slug = '$slug'
                          WHERE id = '$id'";

            if (mysqli_query($conn, $updateSql) === TRUE) {
                $message = "Category Updated Successfully.";
                $messageType = "success";
            } else {
                $message = "Database Error: " . $conn->error;
                $messageType = "danger";
            }
        } else {

            // IMAGE VALIDATION
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            $maxSize = 2 * 1024 * 1024; // 2MB

            if (!in_array($image['type'], $allowedTypes)) {
                $message = "Only JPG, JPEG and PNG images are allowed.";
                $messageType = "danger";
            } elseif ($image['size'] > $maxSize) {
                $message = "Image size must be less than 2MB.";
                $messageType = "danger";
            } else {

                // IMAGE UPLOAD
                $imageName = time() . "_" . basename($image['name']);
                $target_dir = "uploads/category/";
                $target_file = $target_dir . $imageName;

                if (move_uploaded_file($image['tmp_name'], $target_file)) {

                    // DELETE OLD IMAGE
                    if (!empty($category['image']) && file_exists($target_dir . $category['image'])) {
                        unlink($target_dir . $category['image']);
                    }

                    // UPDATE WITH IMAGE
                    $updateSql = "UPDATE categories SET 
                                    name = '$name',
                                    slug = '$slug',
                                    image = '$imageName'
                                  WHERE id = '$id'";

                    if (mysqli_query($conn, $updateSql) === TRUE) {
                        $message = "Category Updated Successfully.";
                        $messageType = "success";
                    } else {
                        $message = "Database Error: " . $conn->error;
                        $messageType = "danger";
                    }
                } else {
                    $message = "Image upload failed";
                    $messageType = "danger";
                }
            }
        }
    }

    // REFRESH DATA
    $result = mysqli_query($conn, $sql);
    $category = mysqli_fetch_assoc($result);
}

// Close DB connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include 'include/navbar.php'; ?>

    <div class="container my-5">
        <div class="row">
            <?php include 'include/sidebar.php'; ?>
            <div class="col-lg-9">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3>Create Category</h3>
                    <a href="category-list.php" class="btn btn-primary">All Category</a>
                </div>
                <?php if (!empty($message)) { ?>
                    <div class="alert alert-<?= $messageType ?>">
                        <?= $message ?>
                    </div>
                <?php } ?>
                <div class="card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Category Name" value="<?= $category['name'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" placeholder="Category Slug" value="<?= $category['slug'] ?>">
                            </div>
                            <div class="mb-3">
                                <label>Current Image</label><br>
                                <img src="uploads/category/<?= $category['image'] ?>" width="120">
                            </div>
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" name="image" placeholder="Category Image">
                            </div>
                            <input type="submit" value="Update" class="btn btn-primary" name="update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>