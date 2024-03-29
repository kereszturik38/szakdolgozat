<?php
include "model/Post.php";
include "model/User.php";

$p = new Post();
$u = new User();

if (isset($_SESSION["loggedIn"]) && isset($_SESSION["uid"])) {
    if (isset($_GET["pageNum"])) {
        $pageNum = $_GET["pageNum"];
    } else {
        $pageNum = 0;
    }
    $postsPerPage = 6;

    $offset = $pageNum * $postsPerPage;

    if (isset($_SESSION["uid"])) {
        $uid = strval($_SESSION["uid"]);
        $numberOfPages = $p->get_number_of_bookmark_pages($postsPerPage, $conn, $uid, 0);
        $bookmarks = $p->get_bookmarks($_SESSION["uid"], $offset, $postsPerPage, $conn);


        echo "<div class='d-grid gap-3'>";
        echo "<div class='container px-4 px-lg-5 my-5'>";
        echo "<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>";
        foreach ($bookmarks as $bookmark) {
            $imgstr = fetch_file($bookmark);
            $u->filterByUID($bookmark->get_post_uid(), $conn);
            include "view/bookmarks.php";
        }

        echo "</div>";
        echo "</div>";
        echo "</div>";
        include "inc/bookmarks_pagination.php";
    }
} else {
    header('location: index.php?page=login');
}
