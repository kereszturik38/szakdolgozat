<?php
include "model/User.php";

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $email = $_POST["email"];

    $user = new User();
    $user->verify($username,$password,$conn);
    $_SESSION["loggedIn"] = true;
    $_SESSION["uid"] = $user->get_uid();
    $_SESSION["username"] = $user->get_username();
    $_SESSION["email"] = $user->get_email();
    $_SESSION["level"] = $user->get_level();
    header("location: index.php");

}


include "view/login.php";
?>