<?php
error_reporting(E_ERROR | E_PARSE);
require "Templates/header.php";
?>
    <?php if ($_SESSION['id']) : ?>
        <div class="container">
            <div class="row m-3">
                <div class="col-lg-6 text-success">
                    Welcome <?php echo $_SESSION["username"]; ?>!
                </div>
                <div class="col-lg-12">
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addTask">
                        Add New Task
                    </button>
                </div>
            </div>
            <div class="row m-3">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Task</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $uId = (int)$_SESSION["id"];
                            $datas = $task->getTaskByUserId($uId);
                            ?>
                            <?php foreach ($datas as $data) : ?>
                                <tr>
                                    <td><?php echo $data[1]; ?></td>
                                    <?php $status = ($data[3]) ? "Completed" : "Pending"; ?>
                                    <td><?php echo $status; ?></td>
                                    <td>
                                        <a href="/todo/Controller/update_task.php?tid=<?php echo $data[0]; ?>" class="btn btn-success btn-sm ms-2">Update</a>
                                        <a href="/todo/Controller/delete_task.php?tid=<?php echo $data[0]; ?>" class="btn btn-danger btn-sm ms-2">Delete</a>
                                    </td>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="staticBackdropLabel">Add New Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/todo/Controller/add_task.php" method="post">
                            <div class="mb-3">
                                <label for="task" class="form-label">Task</label>
                                <input type="text" class="form-control" name="taskName">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="addtasktodb">Add Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <h1 style="text-align: center;" class="mt-5">Please Login First<h1>
            <?php endif; ?>
<?php require_once "Templates/footer.php"; ?>