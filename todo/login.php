<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location: index.php');
    exit;
}
error_reporting(E_ERROR | E_PARSE);
?>
<?php include ('Templates/header.php') ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="/todo/Controller/logincheck.php" method="post">
                    <center>
                        <h3>Login</h3>
                    </center>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                    <a class="text-primary float-end" href="register.php">New User</a>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
<?php include('Templates/footer.php'); ?>