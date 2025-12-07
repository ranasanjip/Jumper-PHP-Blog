<?php

if (isset($_POST['submit'])) {
    $fullName = $_POST['fullname'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($fullName)){
        $message = "Please enter your full name";
        $messageType = 'error';
    }
    if(empty($number)){
        $message = "Please enter your number";
        $messageType = 'error';
    }
    if(empty($email)){
        $message = "Please enter your email";
        $messageType = 'error';
    }
    if(empty($password)){
        $message = "Please enter your password";
        $messageType = 'error';
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body> 

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="blog.php">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="contact.php">Contact</a>
        </li>
      </ul>
        <a href="register.php" class="btn btn-primary me-2">Register</a>
        <a href="login.php" class="btn btn-outline-primary">Login</a>
    </div>
  </div>
</nav>

<div class="container">
    <nav aria-label="breadcrumb" class="my-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Register</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-6 my-auto">
            <?php if (!empty($message)) { ?>
                <div class="alert alert-danger">
                    <?= $message ?>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <form action="register.php" method="post">
                        <label for="name">Name</label>
                        <input name="fullname" type="text" class="form-control mb-3" placeholder="Enter your full name">
                        <label for="phone">Phone</label>
                        <input name="number" type="number" class="form-control mb-3" placeholder="Enter your phone number">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control mb-3" placeholder="Enter your email">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Enter your password">

                        <div class="d-flex">
                            <input class="btn btn-primary mt-3 w-50" type="submit" name="submit" value="Submit">
                            <input class="btn btn-danger mt-3 w-50 ms-3" type="reset" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="img/login.png" alt="Login" class="img-fluid">
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>