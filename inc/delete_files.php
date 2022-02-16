<?php

function delete_files($pid,$uid,$conn){

    $path = "../posts/{$pid}-{$uid}/";
    if(is_dir($path)){
        $files = glob($path . "*",GLOB_MARK);
        foreach($files as $file){
            unlink($file);
        }
        rmdir($path);
        return true;
    }else{
        return false;
    }

}

?>