<?php
    include "../inc/db.php";
    include "../model/Post.php";
    include "../model/User.php";
    include "../inc/delete_files.php";

    $p = new Post();
    $u = new User();

    if(isset($_POST)){

        $pid = $_POST["postid"];
        $request_uid = $_POST["uid"];

        if($p->filterByPID($pid,$conn) && $u->filterByUID($request_uid,$conn)){

            if($p->get_post_uid() === $request_uid || $u->is_admin($request_uid,$conn)){
                if(delete_files($pid,$p->get_post_uid(),$conn)){
                    $p->delete($pid,$conn);
                    echo "Success";
                }else{
                    die("File deletion failure");
                }
                
            }else{
                die("You must be the original uploader to delete this file");
            }
        }else{
            die("Database error");
        }
    }else{
        die("Post not set");
    }

?>