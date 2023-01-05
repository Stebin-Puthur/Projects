<?php
session_start();
require "../Model/Task.php";
$tid = $_GET["tid"];
$task = new Task();
$updateRow = $task->getTaskByTaskId($tid);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand">To Do App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <?php if (!$_SESSION['id']) : ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="login.php">Login</a>
                        </li>
                    <?php endif; ?>
                </ul> 
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                    <input type="hidden" name="tid" value="<?php echo $updateRow["id"]; ?>">
                    <div class="mb-3">
                        <label for="task" class="form-label">Task Name</label>
                        <input type="text" class="form-control" name="updateTaskName" value="<?php echo $updateRow["taskName"]; ?>">
                    </div>
                    <?php
                    $value = $updateRow["status"];
                    $option = ($value) ? "Completed" : "Pending";
                    $option2 = (!$value) ? "Completed" : "Pending";
                    ?>
                    Status
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="updateStatus">
                        <option value="<?php echo $value; ?>"><?php echo $option; ?></option>
                        <option value="<?php echo !$value; ?>"><?php echo $option2; ?></option>
                    </select>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="updateTask">Update Task</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <?php
    if (isset($_POST["updateTask"])) {
        $taskName = $_POST["updateTaskName"];
        $status = $_POST["updateStatus"];
        $tid = $_POST["tid"];
        $task->updateTask($taskName, $status, $tid);
        header("Location:../index.php");
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>