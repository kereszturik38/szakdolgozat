<?php
 include "../inc/db.php";
 include "../model/Comment.php";

$c = new Comment();

if(isset($_POST["comments"])){
    if($c->remove_comments($_POST["comments"],$conn)){
        echo "Success";
    }else{
        die("Error");
    }

}




?>