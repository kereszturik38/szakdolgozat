<?php
    include "../inc/db.php";
    include "../model/Post.php";

    $p = new Post();

    if(isset($_POST)){

        $newdesc = htmlspecialchars($_POST["newdesc"]);
        $pid = $_POST["pid"];

        if($p->filterByPID($pid,$conn)){

            if($p->update_description($newdesc,$pid,$conn)){
                    echo("success");
                }else{
                    die("Description change failure");
                }
                
            }else{
                die("Unknown post");
            }
        
    }else{
        die("Post not set");
    }
