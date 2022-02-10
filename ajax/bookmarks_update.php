<?php
include  "../inc/db.php";
include "../model/Post.php";

$p = new Post();

if(isset($_POST["bookmark"])){
    if($_POST["bookmark"] === "set"){

        $post_id = $_POST["post_id"];
        $user = $_POST["uid"];
        $p->filterByPID($post_id,$conn);
        $p->bookmark($user,$post_id,$conn);
        $p->update_bookmarks($post_id,$conn);
        $count= $p->get_bookmark_count();
        echo $count;
        
    }
    if($_POST["bookmark"] === "unset"){

        $post_id = $_POST["post_id"];
        $user = $_POST["uid"];
        $p->filterByPID($post_id,$conn);
        $p->remove_bookmark($user,$post_id,$conn);
        $p->update_bookmarks($post_id,$conn);
        $count= $p->get_bookmark_count();
        echo $count;
        
    }
    
}

?>