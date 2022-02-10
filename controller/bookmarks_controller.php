<?php
include "model/Post.php";
include "model/User.php";

$p = new Post();
$u = new User();

if(isset($_SESSION["uid"])){
    $bookmarks = $p->get_bookmarks($_SESSION["uid"],$conn);

    echo "<div class='d-grid gap-3'>";
    echo "<div class='container px-4 px-lg-5 my-5'>";
    echo "<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>";
    foreach($bookmarks as $bookmark){
        $imgstr = fetch_image($bookmark);
        $u->filterByUID($bookmark->get_post_uid(),$conn);

        
        include "view/bookmarks.php";
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";

}

?>
