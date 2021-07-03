<?php

namespace gestion\models;

use gestion\lib\AbstractModel;

class ProduitModel extends AbstractModel
{
    public function __construct() {
        parent::__construct();
        $this->tableName = "produit";
        $this->primaryKey = "id_produit";
    }


    public function insert(array $data):bool{
        extract($data);
        $sql= "INSERT INTO $this->tableName 
        (libelle_produit,stock,categorie_id,ref_produit,prix,type)
        VALUES 
        (?,?,?,?,?,?)";
        $result =$this->persit($sql,[$libelle,$stock,$categorie_id,$ref,$prix,$type]);
        return $result["count"]==0?false:true;
    }
    public function LibelleExiste(string $libelle):bool{
        $sql= "SELECT * FROM $this->tableName WHERE libelle_produit=:libelle";
        $result=$this->selectBy($sql,[':libelle'=>$libelle],true);
        return @$result["count"]==0?false:true;
    }

    public function selectNombreId(){
        $sql = "SELECT * FROM $this->tableName ORDER BY ID DESC LIMIT 1";
        $result=$this->selectAll($sql);
        return $result["count"];
    }
    public function selectAll():array {
        $sql="SELECT * FROM $this->tableName a ,categorie b WHERE a.categorie_id = b.id_categorie ";
        $result=$this->selectBy($sql);
        return $result["data"];
    }

   /* public  function ruptureStock(){
        $sql= "SELECT * FROM $this->tableName WHERE stock ='0'";
        $result=$this->selectAll($sql);
        return @$result["count"];
    }
*/

}