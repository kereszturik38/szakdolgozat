<?php
include  "../inc/db.php";
include "../model/Post.php";

$p = new Post();

if(isset($_POST["post_id"])){
    
    $current_visibility = $_POST["visibility"];
    $new_visibility = abs($current_visibility - 1);

    $p->filterByPID($_POST["post_id"],$conn);
    if($p->set_visibility($_POST["post_id"],$new_visibility,$conn)){
        echo "success";
    }else{
        die("DB Error");
    }

}

?>