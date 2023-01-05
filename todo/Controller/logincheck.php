<?php
session_start();
require "../Model/User.php";
error_reporting(E_ERROR | E_PARSE);
$user = new User();

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    $row = $user->getUserByEmail($email);

    if ($row["email"] == $email) {
        if ($row["password"] == $password) {
            $_SESSION["username"] = $row["username"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["id"] = $row["id"];

            header("Location:../index.php");
        } else {
            echo "INVALID PASSWORD";
        }
    } else {
        echo "INVALID EMAIL";
    }
}
