<?php
    include "../inc/db.php";
    include "../model/Post.php";

    $p = new Post();

    if(isset($_POST)){

        $newtitle = htmlspecialchars($_POST["newtitle"]);
        $pid = $_POST["pid"];

        if($p->filterByPID($pid,$conn)){

            if($p->update_title($newtitle,$pid,$conn)){
                    echo("success");
                }else{
                    die("Title change failure");
                }
                
            }else{
                die("Unknown post");
            }
        
    }else{
        die("Post not set");
    }
