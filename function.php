<?php 

function link_generator($length=16) {
    
    $chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
    $code="";
    for($i=0;$i<$length; $i++) {
        $code .= $chars[ rand(0,strlen($chars)-1)];
    }
    
    return $code;
}

?>