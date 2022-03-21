<?php

include "model/Post.php";
include "model/User.php";
include "model/Comment.php";

$p = new Post();
$u = new User();
$c = new Comment();

if(isset($_GET["pid"])){

if($p->filterByPID($_GET["pid"],$conn)){
    $comments = $c->commentsForPID($_GET["pid"],$conn);
    

    include "view/removecomments.php";

}else{
    return "view/404.php";
}


}else{
    include "view/404.php";
}


?>