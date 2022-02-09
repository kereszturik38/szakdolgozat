<?php
include "model/Post.php";
include "model/User.php";
include "model/Comment.php";

$p = new Post();
$u = new User();
$c = new Comment();

if(isset($_POST["bookmark"])){
    if($_POST["bookmark"] === "set"){

        $post_id = $_GET["id"];
        $user = $_SESSION["uid"];
        $p->bookmark($user,$post_id,$conn);
    }
    if($_POST["bookmark"] === "unset"){
        $post_id = $_GET["id"];
        $user = $_SESSION["uid"];
        $p->remove_bookmark($user,$post_id,$conn);
    }
    
}

if(isset($_POST["submit"])){

    $post_id = $_GET["id"];
    $comment_text = $_POST["usercomment"];
    $uploader_id = $_SESSION["uid"];

    if(strlen($comment_text) > 0){
        if($c->leaveComment($post_id,$uploader_id,$comment_text,$conn)){
            echo "success";
            header('location: index.php?page=post&id='.$post_id);
        }else{
            echo "fail";
            header('location: index.php?page=post&id='.$post_id);
        }
        
    }
}

if(isset($_GET["id"])){
    
    $p->filterByPID($_GET["id"],$conn);
    
    $u->filterByUID($p->get_post_uid(),$conn);
    
    $comments = $c->commentsForPID($_GET["id"],$conn);
    
    $imgstr = "posts/" . $p->get_post_id() . "-" . $p->get_post_uid() . "/" . $p->get_post_id() . "." . str_replace("image/","",$p->get_type());

    

    include "view/post.php";

}else{
    header("location: index.php");
}
