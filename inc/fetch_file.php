<?php
function fetch_file(Post $p){
    $imgstr = "posts/" . $p->get_post_id() . "-" . $p->get_post_uid() . "/" . $p->get_post_id() . "." . preg_replace("{image/|video/}","",$p->get_type());
    return $imgstr;
}


?>