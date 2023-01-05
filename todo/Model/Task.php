<?php
require "Connection.php";
class Task extends Connection
{
    public function add_task($taskName, $uId, $status)
    {
        $sql = "INSERT INTO task(taskName,userId,status) VALUES('$taskName',$uId, $status)";
        $this->conn->query($sql);
    }

    public function getTaskByUserId($uId)
    {
        $sql = "SELECT * FROM task WHERE userId=$uId";
        $result = $this->conn->query($sql);
        $row = $result->fetch_all();
        return $row;
    }

    public function getTaskByTaskId($tid)
    {
        $sql = "SELECT * FROM task WHERE id=$tid";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function updateTask($taskName, $status, $tid)
    {
        $sql = "UPDATE task SET taskName = '$taskName' , status = '$status' WHERE id=$tid";
        $this->conn->query($sql);
        return true;
    }

    public function deleteTask($tid)
    {
        $sql = "DELETE FROM task WHERE id=$tid";
        $this->conn->query($sql);
        return true;
    }

    public function viewTask($tid)
    {
        $sql = "SELECT * FROM task WHERE id=$tid";
        $this->conn->query($sql);
        return false;
    }
}
