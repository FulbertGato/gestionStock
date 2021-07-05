<?php
namespace gestion\lib;

class Formulaire{
    public function input(string $name, string $class, string $type){
        echo "<input class=\"$class\"  type=\"$type\" placeholder=\"$name \" name=\"$name\" />";
    }

    public function label(string $name, string $classe=""){
        echo "<label class=\"$classe\">$name</label>";
    }


    public function  option(string $name,string $value){

        echo "<option selected  value=\"$value\" >$name</option>";

    }
}
?>