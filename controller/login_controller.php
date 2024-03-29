<?php
include "model/User.php";

if(isset($_POST["submit"])){
    $username = htmlspecialchars($_POST["username"]);
    $password = md5($_POST["password"]);
    $email = htmlspecialchars($_POST["email"]);

    $user = new User();
    $loginSuccess = $user->verify($username,$email,$password,$conn);
    if($loginSuccess === 0){
        $_SESSION["loggedIn"] = true;
        $_SESSION["uid"] = $user->get_uid();
        $_SESSION["username"] = $user->get_username();
        $_SESSION["email"] = $user->get_email();
        $_SESSION["level"] = $user->get_level();
        $_SESSION["admin"] = $user->is_admin($user->get_uid(),$conn);
        header("location: index.php");
    }else if($loginSuccess === 1){
        echo "<div class='alert alert-danger text-center' role='alert'>Invalid username or password combination.</div>";
    }else if($loginSuccess === 2){
        echo "<div class='alert alert-danger text-center' role='alert'>Something has gone wrong.Try again.</div>";
    }
    

}


include "view/login.php";
?>