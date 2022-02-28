<?php
    include "../inc/db.php";
    include "../model/User.php";

    $u = new User();

    if(isset($_POST)){

        $oldemail = htmlspecialchars($_POST["oldemail"]);
        $newemail = htmlspecialchars($_POST["newemail"]);
        $request_uid = $_POST["uid"];

        if($u->filterByUID($request_uid,$conn)){

            if($u->get_email() === $oldemail){
                if($u->set_email($request_uid,$conn,$newemail)){
                    echo "success";
                }
                }else{
                    die("Email change failure");
                }
                
            }else{
                die("Unknown user");
            }
        
    }else{
        die("Post not set");
    }
