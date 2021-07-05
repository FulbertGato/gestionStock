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

    public function lastID(){
        $sql = "SELECT id_produit from $this->tableName order by id_produit desc";
        $result=$this->selectBy($sql);
        $lastid=$result['data'][0]['id_produit'];
        return $lastid;
    }
    public function selectAll():array {
        $sql="SELECT * FROM $this->tableName a ,categorie b WHERE a.categorie_id = b.id_categorie ";

        $result=$this->selectBy($sql);
        return $result["data"];
    }

   public function setStock(array $produit){
    extract($produit);
    $sql="UPDATE $this->tableName SET stock = ? WHERE id_produit = ?";
    $result =$this->persit($sql,[$stock,$id_produit]);
    return @$result["count"]==0?false:true;
   }

    public function refExiste(string $ref):array{
        $sql= "SELECT * FROM $this->tableName WHERE ref_produit=:ref";
        $result=$this->selectBy($sql,[':ref'=>$ref],true);
        return @$result;
    }


}