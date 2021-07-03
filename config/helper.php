<?php
function dd($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function path(string $uri){
    echo WEB_ROOT.$uri;
}

function passwordGen($nbChar) {
    $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
    srand((double)microtime()*1000000);
    $pass = '';
    for($i=0; $i<$nbChar; $i++){
        $pass .= $chaine[rand()%strlen($chaine)];
        }
    return $pass;
    }

?>