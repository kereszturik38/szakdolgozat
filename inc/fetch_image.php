<?php
function fetch_image(Post $p){
    $imgstr = "posts/" . $p->get_post_id() . "-" . $p->get_post_uid() . "/" . $p->get_post_id() . "." . str_replace("image/","",$p->get_type());
    return $imgstr;
}


?>