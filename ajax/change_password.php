<?php
    include "../inc/db.php";
    include "../model/User.php";

    $u = new User();

    if(isset($_POST)){

        $oldpw = md5($_POST["oldpw"]);
        $newpw = md5($_POST["newpw"]);
        $request_uid = $_POST["uid"];

        if($u->filterByUID($request_uid,$conn)){

            if($u->verify_password($request_uid,$conn,$oldpw)){
                if($u->set_password($request_uid,$conn,$newpw)){
                    echo "success";
                }
                }else{
                    die("Password change failure");
                }
                
            }else{
                die("Unknown user");
            }
        
    }else{
        die("Post not set");
    }
