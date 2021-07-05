<?php


namespace gestion\models;


class CommandeModel extends \gestion\lib\AbstractModel
{

    public function __construct() {
        parent::__construct();
        $this->tableName = "commande";
        $this->primaryKey = "id_commande";
    }


    public function insert(array $data):bool{
        extract($data);
        $sql= "INSERT INTO $this->tableName 
        (ref_commande,produit_id,quantite,total)
        VALUES 
        (?,?,?,?)";
        $result =$this->persit($sql,[$ref_c,$id_produit,$quantite,$total]);
        return @$result["count"]==0?false:true;
    }
    public function lastID(){
        $sql = "SELECT id from $this->tableName order by id desc";
        $result=$this->selectBy($sql);
        $lastid=$result['data'][0]['id'];
        return $lastid;
    }

    public function selectAll():array {
        $sql="SELECT * FROM $this->tableName a , produit b WHERE a.produit_id = b.id_produit ";

        $result=$this->selectBy($sql);
        return $result["data"];
    }
}