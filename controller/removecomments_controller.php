<?php

include "model/Post.php";
include "model/User.php";
include "model/Comment.php";

$p = new Post();
$u = new User();
$c = new Comment();

if(isset($_GET["pid"]) && isset($_SESSION["loggedIn"])){

if($p->filterByPID($_GET["pid"],$conn)){

    if(($p->get_post_uid() === $_SESSION["uid"]) || $_SESSION["admin"] === true){
        $comments = $c->commentsForPID($_GET["pid"],$conn);
        include "view/removecomments.php";
    }else{
        include "view/404.php";
    }
    

}else{
    include "view/404.php";
}


}else{
    include "view/404.php";
}


?>