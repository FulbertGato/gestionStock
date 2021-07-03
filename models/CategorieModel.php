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
        (libelle_categorie,ref)
        VALUES 
        (?,?)";
        $result =$this->persit($sql,[$Libelle,$ref]);
        return $result["count"]==0?false:true;
    }

    public function LibelleExiste(string $libelle):bool{
        $sql= "SELECT * FROM $this->tableName WHERE libelle_categorie=:libelle";
        $result=$this->selectBy($sql,[':libelle'=>$libelle],true);
        return @$result["count"]==0?false:true;
    }

    public function selectNombreId(){
         $sql = "SELECT * FROM $this->tableName ORDER BY ID DESC LIMIT 1";
         $result=$this->selectAll($sql);
         return $result["count"];
    }

}