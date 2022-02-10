<?php
include  "../inc/db.php";
include "../model/Comment.php";
include "../model/Post.php";

$p = new Post();
$c = new Comment();
$u = new User();

if(isset($_POST)){

    $post_id = $_POST["post_id"];
    $comment_text = $_POST["usercomment"];
    $uploader_id = $_POST["uid"];

    if(strlen($comment_text) > 0){
        if($c->leaveComment($post_id,$uploader_id,$comment_text,$conn)){
            $comments = $c->commentsForPID($post_id,$conn);
            if($comments){
                foreach($comments as &$comment){
                    $u->filterByUID($comment->get_uid(),$conn);
                    $comment->set_username($u->get_username());
                }
                echo json_encode($comments);
            }
        }else{
            echo "error";
        }
        
    }
}


?>