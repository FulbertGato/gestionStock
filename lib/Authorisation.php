<?php
namespace gestion\lib;

class Authorisation{
    public static function estConnect():bool{
        return isset($_SESSION["user_connect"]);
    }
    public static function estAdmin():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "admin";
    }
    public static function estVendeur():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "vendeur";
    }
}