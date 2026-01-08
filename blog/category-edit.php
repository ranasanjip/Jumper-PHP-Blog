<?php
    session_start();
    require 'connection.php';
    if (!isset($_SESSION['isLogin'])==true) {
        header("Location: login.php");
        exit;
    }

    $catId = $_GET['id'];
    $selectQuery = "SELECT * FROM categories WHERE id='$catId'";
    $result = mysqli_query($conn, $selectQuery);
    $category = mysqli_fetch_assoc($result);

    if(isset($_POST['update'])){
        $name  = $_POST['name'];
        $slug  = $_POST['slug'];
        $image = $_FILES['image'];

        if(empty($name) && empty($slug)){
            $message = "Please enter name and slug";
            $messageType = 'error';
        }else{
            if($_FILES['image']['error'] == 0){
                $oldImageName = $category['image'];
                $oldImagePath = "uploads/category/" . $oldImageName;
                if (!empty($oldImageName) && file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                $imageName = time() . "_" . basename($_FILES['image']['name']);
                $target_dir = "uploads/category/";
                $target_file = $target_dir . $imageName;
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            
                $sql = "UPDATE categories SET name = '$name', slug = '$slug', image = '$imageName' WHERE id = '$catId'";
                if ($conn->query($sql) === TRUE) {
                    $message = "Category Updated Successfully.";
                    $messageType = 'success';
                }else {
                    echo "Error: ". $conn->error;
                }
            }
        }
    }
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

<?php  include 'include/navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <?php  include 'include/sidebar.php'; ?>
        <div class="col-lg-9">
            <?php if (!empty($message)) { ?>
                <div class="alert alert-<?= $messageType ?>">
                    <?= $message ?>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <form action="category-edit.php?id=<?=$catId?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" 
                            placeholder="Category Name" value="<?=$category['name']?>">
                        </div>
                        <div class="mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" placeholder="Category Slug" value="<?=$category['slug']?>">
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