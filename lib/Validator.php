<?php
namespace gestion\lib;

use DateTime;

class Validator{

    private array $arrayError=[];


    public function estVide(string $val, string $key,   $sms="champ obligatoire"):bool{
 
        if(empty($val)){
            $this->arrayError[$key] = $sms;
            return true;
        }
        return false;
        
    }
    
    
    //Fonction PHP pour controler une adresse Mail
    public function estMail(string $val, string $key,  $sms="verifier votre saisie email"):bool{
        if (!filter_var($val, FILTER_VALIDATE_EMAIL)){
            $this->arrayError[$key] = $sms;
            return false;
        }
        return true;
    }
        
    public function formValide():bool {
        return count($this->arrayError)===0;
    }
    

    /**
     * Get the value of array_error
     */ 
    public function getErrors():array
    {
        return $this->arrayError;
    }
    public function setErrors(string $key, string $error):void
    {
         $this->arrayError[$key]=$error;
    }


    function isValidDate($date, $format = 'Y-m-d'){
        $dt = DateTime::createFromFormat($format, $date);
        return $dt && $dt->format($format) === $date;
    }
}
?>