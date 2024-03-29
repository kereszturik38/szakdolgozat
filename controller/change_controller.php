<?php
include "model/Post.php";

if(isset($_SESSION["loggedIn"]) && isset($_SESSION["uid"])){
    if($_GET["option"] === "username"){
        include "view/username.php";
    }else if($_GET["option"] === "password"){
        include "view/password.php";
    }else if($_GET["option"] === "email"){
        include "view/email.php";
    }else if($_GET["option"] === "pfp"){
        include "view/pfp.php";
    }else if($_GET["option"] === "description" && isset($_GET["id"])){
        $p = new Post();
        if($p->filterByPID($_GET["id"],$conn)){
            if($p->get_post_uid() === $_SESSION["uid"] || $_SESSION["admin"] === true){
                $pid = $_GET["id"];
                include "view/description.php";
            }
        }else{
            include "view/404.php";
        }
        
    }else if($_GET["option"] === "title" && isset($_GET["id"])){
        $p = new Post();
        if($p->filterByPID($_GET["id"],$conn)){
            if($p->get_post_uid() === $_SESSION["uid"] || $_SESSION["admin"] === true){
                $pid = $_GET["id"];
                include "view/title.php";
            }
        }else{
            include "view/404.php";
        }
        
    }
    
    else{
        header('location: index.php?page=login');
    }
    
}else{
    header('location: index.php?page=login');
}


?>