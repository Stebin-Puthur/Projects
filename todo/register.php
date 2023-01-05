<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location: login.php');
    exit;
}
error_reporting(E_PARSE | E_ERROR);
require "Model/User.php";

$usernameErr = $emailErr = $passwordErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST['username'])) && empty(trim($_POST['email'])) && empty(trim($_POST['password']))) {
        $usernameErr = "Username is required";
        $emailErr = "Email is required";
        $passwordErr = "Password is required";
    } elseif (empty(trim($_POST['username']))) {
        $usernameErr = "Username is required";
    } elseif (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } elseif (empty(trim($_POST['password']))) {
        $passwordErr = "Password is required";
    } else {
        $user = new User();
        if (isset($_POST["usertodb"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = md5($_POST["password"]);
            $user->register($username, $email, $password);
            header("location: login.php");
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">To Do App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 float-end">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username"><span class="text-danger">* <?php echo $usernameErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email"><span class="text-danger">* <?php echo $emailErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password"><span class="text-danger">* <?php echo $passwordErr; ?></span>
                    </div>
                    <button type="submit" name="usertodb" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <?php include('Templates/footer.php'); ?>