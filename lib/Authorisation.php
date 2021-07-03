<?php
namespace gestion\lib;

class Authorisation{
    public static function estConnect():bool{
        return isset($_SESSION["user_connect"]);
    }
    
}