<?php

if (isset($_GET["page"])) {
    if(file_exists("controller/" . $_GET["page"] . "_controller.php")){
        include "controller/" . $_GET["page"] . "_controller.php";
    }else{
        include "view/404.php";
    }

} else{
    include "model/Post.php";
    include "model/User.php";

    $p = new Post();
    $u = new User();
    $results = $p->get_popular(5,$conn);
    if ($results && $results->num_rows > 0) {      
        $topImages = array();  
        while ($row = $results->fetch_assoc()) {
            $p->filterByPID($row["post_id"],$conn);
            $imgstr = fetch_file($p);
            array_push($topImages,clone $p);
        }
        include "view/homepage.php";
    }

}

?>
</div>
</div>