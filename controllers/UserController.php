<?php
namespace gestion\controllers;

use DateTime;
use gestion\lib\Request;
use gestion\lib\Session;
use gestion\lib\Response;
use gestion\lib\Formulaire;
use gestion\models\UserModel;
use gestion\lib\Authorisation;
use gestion\lib\PasswordEncoder;
use gestion\lib\AbstractController;

class UserController extends AbstractController{

    private UserModel $model;
    public function __construct(){
        parent::__construct();
        $this->model= new UserModel();
    }

    public function myInfo(){
        if(!Authorisation::estConnect()){
            Response::redirectUrl("securite/login");
        }
        $user=Session::getSession("user_connect");
       // dd($user);
       $this->render('user/show.user',["user"=>$user]);

    }


    public function register(Request $request){

        if(!Authorisation::estAdmin()){
            Response::redirectUrl("securite/login");
        }

        
          $form = new Formulaire();

        if($request->isPost()){
            $data = $request->getBody();
            $this->validator->estVide($data["nom"], "nom");
            $data["nom"]=strip_tags($data["nom"]);
            $this->validator->estVide($data["prenom"], "prenom");
            $data["prenom"]=strip_tags($data["prenom"]);
            if(!$this->validator->estVide($data["password"], "password")){
                $data["password"]=strip_tags($data["password"]);
                if(!$this->validator->estVide($data["Cpassword"], "Cpassword")){
                    $data["Cpassword"]=strip_tags($data["Cpassword"]);
                    if($data["password"] != $data["Cpassword"]){

                        $this->validator->setErrors("Cpassword","vos mot de passe ne correspond pas");
                    }
                }

            }
            if(!$this->validator->estVide($data["email"], "email")){
                $data["email"]=strip_tags($data["email"]);
                if($this->validator->estMail($data["email"], "email")){
                    
                    if($this->model->loginExiste($data["email"])){
                        $this->validator->setErrors("login","ce login existe deja dans le systeme");
                    }
                }
            }

            if($this->validator->formValide()){
                $data["password"]=PasswordEncoder::encode($data["password"]);
                $this->model->insert($data);
                Response::redirectUrl("user/showAllUser");
            }else{
                Session::SetSession("array_error",$this->validator->getErrors());
                Session::SetSession("array_post",$data);
               }
        }
        $this->render("user/register",["form"=>$form]);
    }

    public function showAllUser(){

        if(!Authorisation::estConnect()){
            Response::redirectUrl("user/login");
        }
        $data= $this->model->selectAll();  
        $this->render("user/liste.user", ["users" => $data['data']]);
    }

    public function update(Request $request){
        if($request->isPost()){
            $data=$request->getBody();
           // dd($data);
           $user= $this->model->selectById($data['id']);
          // dd($user);
            $this->validator->estVide($data["nom"], "nom");
            $this->validator->estVide($data["prenom"], "prenom");
            if(!$this->validator->estVide($data["email"], "email")){
                if($this->validator->estMail($data["email"], "email")){
                    if(!$data['email'] == $user['data']['email']){

                        if($this->model->loginExiste($data["email"])){
                            $this->validator->setErrors("login","ce login existe deja dans le systeme");
                        }
                    }
                    
                }
            }
            if(!$this->validator->estVide($data["password"], "password")){
                if(PasswordEncoder::decode($data["password"], $user['data']["password"])){

                    if($data["Npassword"] != ""){ 
                        $data["Npassword"]=PasswordEncoder::encode($data["Npassword"]); 
                        $data['md']=true;    
                    }

            }else{
                $this->validator->setErrors("passNC","ancien mot de passe incorrect");
            }
        }

            if($this->validator->formValide()){
                if($data["Npassword"] != ""){ 
                    $this->model->update($data);    
                 }else{
                    $data['md']=false;
                    $this->model->update($data); 
                }
                
                Response::redirectUrl("securite/logout");
            }else{
                Response::redirectUrl("user/myInfo"); 
            }

        }else{
            Response::redirectUrl("user/myInfo"); 
        }
    }
}