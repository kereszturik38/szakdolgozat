<?php
include "inc/searchfield.php";

if(isset($_GET["search"])){
    echo var_dump($_GET["search"]);
}

include "view/results.php";

?>