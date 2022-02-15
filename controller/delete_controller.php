<?php
   include "model/Post.php";
   include "model/User.php";

    $p = new Post();
    $u = new User();

    if(isset($_SESSION["uid"])){

        $pid = $_GET["id"];
        $request_uid = $_SESSION["uid"];

        if($p->filterByPID($pid,$conn) && $u->filterByUID($request_uid,$conn)){

            if($p->get_post_uid() === $request_uid || $u->is_admin($request_uid,$conn)){
                include "view/delete_form.php";
            }else{
                echo "<h3 class='alert alert-danger'>You must be the original uploader to delete this file.</h3>";
            }
        }else{
            echo "<h3 class='alert alert-danger'>Database error</h3>";
        }
    }else{
        echo "<h3 class='alert alert-danger'>You must be logged in to delete posts</h3>";
    }

?>