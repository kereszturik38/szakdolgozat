<?php
include "model/Post.php";
include "model/User.php";
include "model/Comment.php";

if(isset($_GET["id"])){
    $p = new Post();
    $p->filterByPID($_GET["id"],$conn);
    $u = new User();
    $u->filterByUID($p->get_post_uid(),$conn);
    $c = new Comment();
    $comments = $c->commentsForPID($_GET["id"],$conn);
    $imgstr = "posts/" . $p->get_post_id() . "-" . $p->get_post_uid() . "/" . $p->get_post_id() . "." . str_replace("image/","",$p->get_type());

    include "view/post.php";

}else{
    header("location: index.php");
}




?>