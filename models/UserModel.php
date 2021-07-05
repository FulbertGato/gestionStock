<?php

namespace gestion\models;

use gestion\lib\AbstractModel;

class UserModel extends AbstractModel
{
    public function __construct() {
        parent::__construct();
        $this->tableName = "user";
        $this->primaryKey = "id";
    }


    public function insert(array $user):bool{
        extract($user);
        $sql= "INSERT INTO $this->tableName 
        (nom,prenom,email,password,role)
        VALUES 
        (?,?,?,?,?)";
        $result =$this->persit($sql,[$nom,$prenom,$email,$password,$role]);
        return $result["count"]==0?false:true;
    }

    public function loginExiste(string $email):bool{
        $sql= "SELECT * FROM $this->tableName WHERE email=:email";
        $result=$this->selectBy($sql,[':email'=>$email],true);
        return @$result["count"]==0?false:true;
    }

    public function selectUserByLogin ( string $email ) : array
    {
        $sql    = "SELECT * FROM $this->tableName
        WHERE email=?";
        $result = $this -> selectBy ( $sql , [ $email ] , true );
        return $result[ "count" ] == 0 ? []: $result[ "data" ];
    }

    public function update (array $data):int{
        extract($data);
        if($md){
            $sql = "UPDATE $this->tableName SET nom = ?, prenom = ? , email = ? , password = ? WHERE $this->primaryKey = ?";
            $result =$this->persit($sql,[$nom,$prenom,$email,$Npassword,$id]);
        }else{

            $sql = "UPDATE $this->tableName SET nom = ?, prenom = ? , email = ? WHERE $this->primaryKey = ?";
            $result =$this->persit($sql,[$nom,$prenom,$email,$id]);
        }
        return 1;
    }
}