<?php
namespace gestion\controllers;
use gestion\lib\Request;
use gestion\lib\Session;
use gestion\lib\Response;
use gestion\lib\Formulaire;
use gestion\lib\Authorisation;
use gestion\models\CategorieModel;
use gestion\lib\AbstractController;

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
          //  dd($data);
            if(!$this->validator->estVide($data["Libelle"], "Libelle")){
                    if($this->model->LibelleExiste($data["Libelle"])){
                        $this->validator->setErrors("Libelle","cette categorie existe deja ");
                    }  
            }

            if($this->validator->formValide()){
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

        if(!Authorisation::estConnect()){
            Response::redirectUrl("user/login");
        }
        $data= $this->model->selectAll();  
        $this->render('categorie/show.categorie', ["categories" => $data['data']]);
    }

    public function generateMatricule(){
        $NombreId = $this->model->selectNombreId();
        $mat= $NombreId+1;
        $matrice= "REF00".$mat;
        return $matrice;
    }

}

?>