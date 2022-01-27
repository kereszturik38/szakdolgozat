<?php

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $email = $_POST["email"];

    $sql = "INSERT INTO user (username,email,password) VALUES ('{$username}','{$email}','{$password}')";
    $conn->query($sql);
    
}


include "view/register.php";
?>