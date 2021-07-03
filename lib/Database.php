<?php
namespace gestion\lib;

class DataBase {
    private $pdo;
   public function __construct(){
        /* Connexion à une base MySQL avec l'invocation de pilote */
        $dsn = 'mysql:dbname=gestionStock;host=localhost';
        $user = 'root';
        $password = '';
    
        try {
            $this->pdo = new \PDO($dsn, $user, $password);
            //activation des erreurs de PDO 
            $this->pdo->exec("SET NAMES utf8");
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
         
        } catch (\Exception $ex) {
             Response::redirectUrl("error/error_conexion");
        }
    
    }
    public function closeConnection(){
        $this->pdo = null;
    }
    
    public function executeSelect(string $sql,array $data=[],bool $single=false):array{
        
        $stm=$this->pdo->prepare($sql);
        $stm->execute($data);
        if($single){
            $result=$stm->fetch();
        }else{
            $result=$stm->fetchAll();
        }
        $this->closeConnection();
    
        return [
            "data"=>$result,
            "count" => $stm->rowCount()
        ];
    }
    
    function executeUpdate(string $sql, array $data):int{
        
        $stm=$this->pdo->prepare($sql);
        $stm->execute($data);
        
        $count=stripos($sql,'insert')==false?$stm->rowCount():$this->pdo->lastInsertId();
        $this->closeConnection();
        return $count;
    }
}



?>