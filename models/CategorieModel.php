<?php

namespace gestion\models;

use gestion\lib\AbstractModel;

class CategorieModel extends AbstractModel
{
    public function __construct() {
        parent::__construct();
        $this->tableName = "categorie";
        $this->primaryKey = "id_categorie";
    }


    public function insert(array $data):bool{
        extract($data);
        $sql= "INSERT INTO $this->tableName 
        (libelle_categorie,ref,status_categorie)
        VALUES 
        (?,?,?)";
        $result =$this->persit($sql,[$Libelle,$ref,$status]);
        return $result["count"]==0?false:true;
    }

    public function LibelleExiste(string $libelle):bool{
        $sql= "SELECT * FROM $this->tableName WHERE libelle_categorie=:libelle";
        $result=$this->selectBy($sql,[':libelle'=>$libelle],true);
        return @$result["count"]==0?false:true;
    }

    public  function setStatus(array $data){
        extract($data);
        $sql="UPDATE $this->tableName SET status_categorie = ? WHERE $this->primaryKey = ?";
        $result =$this->persit($sql,[$status,$id]);
        return $result["count"]==0?false:true;
    }

    public function selectNombreId(){
         $sql = "SELECT * FROM $this->tableName ORDER BY ID DESC LIMIT 1";
         $result=$this->selectAll($sql);
         return $result["count"];
    }



}