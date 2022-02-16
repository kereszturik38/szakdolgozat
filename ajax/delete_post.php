<?php
    include "../inc/db.php";
    include "../model/Post.php";
    include "../model/User.php";

    $p = new Post();
    $u = new User();

    if(isset($_POST)){

        $pid = $_POST["postidid"];
        $request_uid = $_POST["uid"];

        if($p->filterByPID($pid,$conn) && $u->filterByUID($request_uid,$conn)){

            if($p->get_post_uid() === $request_uid || $u->is_admin($request_uid,$conn)){
                $p->delete($pid,$conn);
                unlink("../". fetch_file($p));
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