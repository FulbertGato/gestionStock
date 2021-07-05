<?php


namespace gestion\controllers;


use gestion\lib\Authorisation;
use gestion\lib\Formulaire;
use gestion\lib\Request;
use gestion\lib\Response;
use gestion\lib\Session;
use gestion\models\CommandeModel;
use gestion\models\ProduitModel;

class CommandeController extends \gestion\lib\AbstractController
{

    private CommandeModel $model;

    public function __construct(){
        parent::__construct();
        $this->model= new CommandeModel();
    }
    public function addCommande(Request $request){


        if(!Authorisation::estConnect()){
            Response::redirectUrl("securite/login");
        }
        $model_produit= new ProduitModel();

        if($request->isPost()){
            $data = $request->getBody();
            //dd($data);
            $model_produit= new ProduitModel();
            if(isset($data["reference"])){
                if(!$this->validator->estVide($data["reference"], "reference")){

                    $data["reference"]=strip_tags($data["reference"]);
                    if($model_produit->refExiste($data["reference"])["count"]==0){
                       $this->validator->setErrors("refE","Référence incorrecte ");
                    }
                }
            }else{
                //cet message apparait car l'utilisateur a modifier le name de la balise
                $this->validator->setErrors("refE","haha tu crois j'y avais pas pensez?");
            }
            $model_produit= new ProduitModel();
            $p=$model_produit->refExiste($data["reference"])["data"];
            if(!intval($data["quantite"])<1){
                
                if($p['stock']<$data["quantite"]){
                    $this->validator->setErrors("quantiteI","stock insuffisant");
                }
                
            }else{
                $this->validator->setErrors("quantite","veuillez saissir un stock correct");
            }

            if($this->validator->formValide()){
                

               
                //$p['quantite' => ];
                $p['quantite']=$data['quantite'];
                //dd($p);
                $_SESSION['produitsV'][]=$p;
                //Session::SetSession("produits",$_SESSION['produitsV']);
                Response::redirectUrl("commande/addCommande");
            }else{
               // die("tout faux");
               Session::SetSession("array_error",$this->validator->getErrors());
               Session::SetSession("produits",$_SESSION['produits']);
               Response::redirectUrl("commande/addCommande");
            }
        }

        $form = new Formulaire();

        $data_produit= $model_produit->selectAll();

        $r=0;
        $v=0;
        $p=0;
        foreach ($data_produit as $d){
            if($d['stock']=="0"){
                $r=$r+1;
            }
            if($d['type']=="virtuelle"){
                $v=$v+1;
            }
            if($d['type']=="physique"){
                $p=$p+1;
            }

        }


        $this->render("commande/new.commande",["produits" => $data_produit,"form"=>$form]);
    }

    public function valideCommande(){
        if(!Authorisation::estConnect()){
            Response::redirectUrl("securite/login");
        }
        $produitsV = $_SESSION['produitsV'];
        //dd($produitsV);
        unset($_SESSION['produitsV']);
        $model_c= new CommandeModel();
        $model_p = new ProduitModel();
       foreach ($produitsV as $p){
           $id_produit=0;
            $p['stock']=$p['stock']-$p['quantite'];
            $p['total']=$p['quantite']*$p['prix'];
            $p['ref_c']=$this->generateReference();
            //dd($p);
            $model_c->insert($p);
            $model_p->setStock($p);
        }
        Response::redirectUrl("commande/addCommande");
    }


    public function annulerCommande(){
        if(!Authorisation::estConnect()){
            Response::redirectUrl("securite/login");
        }
        unset($_SESSION['produitsV']);
        Response::redirectUrl("commande/addCommande");
    }


    public function  showAllCommande(){

        if(!Authorisation::estConnect()){
            Response::redirectUrl("securite/login");
        }
        $data= $this->model->selectAll();
        $v=0;
        $p=0;
        $totaux=0;
        foreach ($data as $d){
            
            if($d['type']=="virtuelle"){
                $v=$v+1;
            }
            if($d['type']=="physique"){
                $p=$p+1;
            }

            $totaux = $totaux+$d['total'];

        }
        $this->render('commande/show.commande',['commandes'=>$data,'virtu'=>$v,'phy'=>$p,'totaux'=>$totaux]);
    }
    
    public function generateReference(){
        $model_c= New CommandeModel();
        $lastId = $model_c->lastID();
        $mat= $lastId+1;
        $reference = "COM00".$mat;
        return  $reference;
    }
}