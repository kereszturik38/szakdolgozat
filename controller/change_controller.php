<?php
if(isset($_SESSION["uid"])){
    if($_GET["option"] === "username"){
        include "view/username.php";
    }else if($_GET["option"] === "password"){
        include "view/password.php";
    }else if($_GET["option"] === "email"){
        include "view/email.php";
    }else{
        header('location: index.php');
    }
    
}else{
    header('location: index.php');
}


?>