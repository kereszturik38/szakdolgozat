<?php
if(isset($_SESSION["loggedIn"])){
    include "view/settings.php";
}else{
    header('location: index.php?page=login');
}


?>