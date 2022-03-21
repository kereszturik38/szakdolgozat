<?php
include "model/Post.php";
include "model/User.php";
include "model/Comment.php";

$p = new Post();
$u = new User();
$c = new Comment();



if (isset($_GET["id"])) {

    $p->filterByPID($_GET["id"], $conn);

    $u->filterByUID($p->get_post_uid(), $conn);

    $comments = $c->commentsForPID($_GET["id"], $conn);

    $imgstr = "posts/" . $p->get_post_id() . "-" . $p->get_post_uid() . "/" . $p->get_post_id() . "." . preg_replace("{image/|video/}", "", $p->get_type());

    if (isset($_SESSION["uid"])) {
        $is_bookmarked = $p->is_bookmarked($_SESSION["uid"], $p->get_post_id(), $conn);
    } else {
        $is_bookmarked = false;
    }


    $icon = $is_bookmarked ? 'bi-bookmark-fill ' : 'bi-bookmark ';

    if ($p->get_visible() === 0) {
        if ((isset($_SESSION["loggedIn"]) && $_SESSION["uid"] === $p->get_post_uid()) || $_SESSION["admin"] === true) {
            include "view/post.php";
        } else {
            header("location: index.php");
        }
    } else {
        include "view/post.php";
    }
} else {
    header("location: index.php");
}
