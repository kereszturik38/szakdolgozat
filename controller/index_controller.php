<?php
include "model/Post.php";
include "inc/searchfield.php";

if(isset($_GET["search"])){
    
    $search = htmlspecialchars($_GET["search"]);
    $select = $_GET["select"];

    $p = new Post();

    $p->searchByPID(211,$conn);
    
    $path = glob("./posts/" . $p->get_post_id() . "/" . $p->get_post_id() . ".png");
    echo end($path);
    if($path != false){
        $imgstr =  end($path);
    }
    

}

include "view/results.php";

?>