<?php
namespace gestion\controllers;
use gestion\lib\Request;
use gestion\lib\Session;
use gestion\lib\Response;
use gestion\lib\Formulaire;
use gestion\lib\Authorisation;
use gestion\models\CategorieModel;
use gestion\lib\AbstractController;
use gestion\models\ProduitModel;

class CategorieController extends AbstractController{

    private CategorieModel $model;
    private Formulaire $form;
    public function __construct(){
        parent::__construct();
        $this->model= new CategorieModel();
        $this->form = new Formulaire();
    }


    public function addCategorie(Request $request){
        if(!Authorisation::estConnect()){
            Response::redirectUrl("user/login");
        }


        if($request->isPost()){

            $data=$request->getBody();
            if(isset($data["Libelle"])){
                if(!$this->validator->estVide($data["Libelle"], "Libelle")){
                    $data["Libelle"]=strip_tags($data["Libelle"]);
                    if($this->model->LibelleExiste($data["Libelle"])){
                        $this->validator->setErrors("libelleE","cette categorie existe deja ");
                    }
                }
            }else{
                //cet message apparait car l'utilisateur a modifier le name de la balise
                $this->validator->setErrors("libelle","haha tu crois j'y avais pas pensez?");
            }

            if($this->validator->formValide()){
               $data['ref']=$this->generateMatricule();
               // dd($data);
                $this->model->insert($data);
                Response::redirectUrl("categorie/addCategorie");
            }else{
                Session::SetSession("array_error",$this->validator->getErrors());
                Response::redirectUrl("categorie/addCategorie");
            }
        }

        $ref= $this->generateMatricule();
        $this->render('categorie/add.categorie',['ref'=>$ref,'form'=>$this->form]);
    }


    public function showAllCategorie(){
        $model_produit = new ProduitModel();
        if(!Authorisation::estConnect()){
            Response::redirectUrl("user/login");
        }
        $data= $this->model->selectAll();
        $data_product= $model_produit->selectAll();
      //dd($data_product);
        $this->render('categorie/show.categorie', ["categories" => $data['data'],"produits"=>$data_product]);
    }

    public function setStatus(Request  $request){
        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("categorie/showAllCategorie");
        }
        $id_cat=$request->getParams()[0];
        $cat=$this->model->selectById($id_cat);
        //dd($cat);
        if($cat['count']==0){
            Response::redirectUrl("categorie/showAllCategorie");
        }else{
          //  dd($cat);
            $data=[];
            if($cat['data']['status_categorie']== "active"){
                $data=["status"=> "inactive ","id"=>$cat['data']['id_categorie']];
               // dd($data);
                $this->model->setStatus($data);
                Response::redirectUrl("categorie/showAllCategorie");
            }else{

                $data=["status"=> "active","id"=>$cat['data']['id_categorie']];
               // dd($data);
                $this->model->setStatus($data);
                Response::redirectUrl("categorie/showAllCategorie");
            }
        }
    }

    public function deleteCategorie(Request  $request){
        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("categorie/showAllCategorie");
        }
        $id_cat=$request->getParams()[0];
        $cat=$this->model->selectById($id_cat);

        if($cat['count']==0){
            Response::redirectUrl("categorie/showAllCategorie");
        }else{
               $this->model= new CategorieModel();

                $this->model->remove($id_cat);
                Response::redirectUrl("categorie/showAllCategorie");

        }
    }

    public function generateMatricule(){
        $model= new CategorieModel();
        $NombreId = $model->selectNombreId();
        $mat= $NombreId+1;
        $matrice= "REF00".$mat;
        return $matrice;
    }

}

?>