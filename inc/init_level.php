<?php

function update_level($uid,$level,$conn){
    $stmt = $conn->prepare("UPDATE user SET level =? WHERE uid LIKE ?");
    $stmt->bind_param("is",$level,$uid);
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}    

if(!isset($_SESSION["loggedIn"])){
    
        $stmt = $conn->prepare("SELECT uid,COUNT(post_id) as postNum,sum(bookmark_count) as bookmarkNum,sum(comment_count) as commentNum FROM post WHERE visible=1 GROUP BY uid");
        if($stmt->execute()){
            $result =  $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $lvl = 1;
                $avg = ($row["bookmarkNum"] + $row["commentNum"]) / 2;
                $uid = $row["uid"];

                if($row["postNum"] > 10 && $avg > 5.0){
                    $lvl = 2;
                    update_level($uid,$lvl,$conn);
                }else if($row["postNum"] > 30 && $avg > 10.0){
                    $lvl = 3;
                    update_level($uid,$lvl,$conn);
                }else{
                    update_level($uid,1,$conn);
                }
            }
            
           }else{
            return false;
        }
    
}
