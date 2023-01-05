<?php
session_start();
require "../Model/Task.php";
$task = new Task();
if (isset($_POST["addtasktodb"])) {
    $taskName = $_POST["taskName"];
    $userId = (int)$_SESSION["id"];

    $task->add_task($taskName, $userId, 0);

    header("Location:../index.php");
}
