<?php
include "model/Post.php";
include "model/User.php";
include "model/Comment.php";

$p = new Post();
$u = new User();
$c = new Comment();



if(isset($_GET["id"])){
    
    $p->filterByPID($_GET["id"],$conn);
    
    $u->filterByUID($p->get_post_uid(),$conn);
    
    $comments = $c->commentsForPID($_GET["id"],$conn);
    
    $imgstr = "posts/" . $p->get_post_id() . "-" . $p->get_post_uid() . "/" . $p->get_post_id() . "." . str_replace("image/","",$p->get_type());

    $is_bookmarked = $p->is_bookmarked($_SESSION["uid"],$p->get_post_id(),$conn);
    $icon = $is_bookmarked ? 'bi-bookmark-fill ' : 'bi-bookmark ';

    include "view/post.php";

}else{
    header("location: index.php");
}
