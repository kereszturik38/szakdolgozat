<?php
include "model/User.php";

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $email = $_POST["email"];

    $user = new User();
    $results = $user->verify($username,$password,$conn);
    if($results){
        if($results->num_rows > 0){
            while($row = $results->fetch_assoc){
                $_SESSION["loggedIn"] = true;
                $_SESSION["uid"] = $row["uid"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["level"] = $row["level"];
            }
            header('location:index.php');
        }else{
            echo "Invalid username/password";
        }
    }else{
        echo "Something went wrong.Try again.";
    }
}


include "view/login.php";
?>