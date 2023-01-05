<?php
session_start();
require "../Model/Task.php";
$tid = $_GET["tid"];
$task = new Task();
$task->deleteTask($tid);
header("Location:../index.php");