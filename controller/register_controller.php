<?php
include "model/User.php";


if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $email = $_POST["email"];

    $user = new User();
    if($user->register($username,$email,$password,$conn)){
        header('location:index.php?page=login');
    }else{
        echo "Something has gone wrong.Try again";
    }
}


include "view/register.php";
