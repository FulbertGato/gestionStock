<?php
namespace gestion\controllers;

use gestion\lib\AbstractController;
use gestion\lib\Authorisation;
use gestion\lib\Formulaire;
use gestion\lib\Request;
use gestion\lib\Response;
use gestion\lib\Session;
use gestion\models\CategorieModel;
use gestion\models\ProduitModel;

class ProduitController extends  AbstractController{
    private ProduitModel $model;
    private CategorieModel $model_categorie;

    public function __construct(){
        parent::__construct();
        $this->model= new ProduitModel();
        $this->form = new Formulaire();
        $this->model_categorie =new CategorieModel();
    }

    public function  showAllProduit(){
        if(!Authorisation::estConnect()){
            Response::redirectUrl("user/login");
        }
        $data= $this->model->selectAll();
     //  $nbreProduitRuptureStock = $this->model->ruptureStock();
      // dd($nbreProduitRuptureStock );
        $r=0;
        $v=0;
        $p=0;
        foreach ($data as $d){
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
   // $this->layout="vendor";
        $this->render('produit/show.produit', ["produits" => $data,"nbre_pupture"=>$r,"nbre_physique"=>$p,"nbre_virtuelle"=>$v]);
    }

    public function addProduit(Request  $request){
      if($request->isPost()){

          $data = $request->getBody();
          //dd($data);
          if(!$this->validator->estVide($data["libelle"], "libelle")){
              if($this->model->LibelleExiste($data["libelle"])){
                  $this->validator->setErrors("libelle","cet produit existe deja ");
              }
          }
          //$this->validator->estVide($data["stock"], "stock");
            if(empty($data["stock"])){
                $data["stock"]="0";
            }
          if(intval($data["stock"])<0){
              $this->validator->setErrors("stockM","veuillez saissir un stock correct");
          }
          $this->validator->estVide($data["prix"], "prix");
          if(intval($data["prix"])<=0){
              $this->validator->setErrors("prixM","veuillez saissir un prix correct");
          }
          if(intval($data["categorie_id"])==0){
              $this->validator->setErrors("categorie_id","veuillez choisir une catégorie");
          }

          if($data["type"]=="nulle"){
              $this->validator->setErrors("type","veuillez choisir une type");
          }

          if($this->validator->formValide()){
              $this->model->insert($data);

              Response::redirectUrl("produit/addProduit");
          }else{
              Session::SetSession("array_error",$this->validator->getErrors());
              Response::redirectUrl("produit/addProduit");
          }
      }

        $categories=$this->model_categorie->selectAll();

        $ref= $this->generateReference();
       // dd($ref);
        $this->render('produit/add.produit',['categories'=>$categories['data'],'form'=>$this->form,'ref'=>$ref]);
    }

    public function generateReference(){
        $lastId = $this->model->lastID();
       $mat= $lastId+1;
     $reference = "PROD00".$mat;
        return  $reference;
    }

}
