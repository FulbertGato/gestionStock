<?php

namespace gestion\lib;
class Response {

    public static function redirectUrl(string $uri ):void{
       @ header("location:".WEB_ROOT.$uri);
        exit();
    }
}
?>