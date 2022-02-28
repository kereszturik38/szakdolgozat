<?php
    include "../inc/db.php";
    include "../model/User.php";
    include "../inc/update_session.php";

    $u = new User();

    if(isset($_POST)){

        $olduser = htmlspecialchars($_POST["olduser"]);
        $newuser = htmlspecialchars($_POST["newuser"]);
        $request_uid = $_POST["uid"];

        if($u->filterByUID($request_uid,$conn)){

            if($u->get_username() === $olduser){
                if($u->set_username($request_uid,$conn,$newuser)){
                    update_session("username",$newuser);
                    echo "Success";
                }
                }else{
                    die("Username change failure");
                }
                
            }else{
                die("Unknown user");
            }
        
    }else{
        die("Post not set");
    }
