<?php
require "Connection.php";
class User extends Connection
{
    public function register($username, $email, $password)
    {
        $sql = "INSERT INTO user (username,email,password) VALUES('$username','$email','$password')";
        $this->conn->query($sql);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM user where email='$email'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
}
