<?php
namespace gestion\controllers;

use gestion\lib\Request;
use gestion\lib\Session;
use gestion\lib\Response;
use gestion\lib\Formulaire;
use gestion\models\UserModel;
use gestion\lib\Authorisation;
use gestion\lib\PasswordEncoder;
use gestion\lib\AbstractController;

class securiteController extends AbstractController {

    public function login(Request $request){

        if(Authorisation::estConnect()){
            Response::redirectUrl("user/register");
        }
        

        if($request->isPost()){
            $modelEtudiant=new UserModel();

            $data= $request->getBody();
            if(!$this->validator->estVide($data["email"], "email")){
                $data["email"]=strip_tags($data["email"]);
                $this->validator->estMail($data["email"], "email");
            }
            $this->validator->estVide($data["password"], "password");
            $data["password"]=strip_tags($data["password"]);
            if($this->validator->formValide()){
                // login et mot de passe bien saisie sans erreur
                $user = $modelEtudiant->selectUserByLogin($data["email"] );
                if(empty($user)){
                    $this->validator->setErrors("error_login","login ou mot de passe incorrect ");
                    Session::setSession("array_error",$this->validator->getErrors());
                   //Response::redirectUrl("etudiant/login");
                }else{

                    if(PasswordEncoder::decode($data["password"], $user["password"])){

                        unset($user["password"]);
                        Session::setSession("user_connect",$user);
                        Response::redirectUrl("user/myInfo");
                        
                    }else{
                        $this->validator->setErrors("error_login","login ou mot de passe incorrect passe");
                        Session::setSession("array_error",$this->validator->getErrors());
                        //Response::redirectUrl("etudiant/login");
                    }
                }

            }else{
                //Erreur de validation donc redirection vers page de connexion
                Session::SetSession("array_error",$this->validator->getErrors());
            }
        }
        $form = new Formulaire();
        $this->render("securite/login",["form"=>$form]);
    }
    
    public function logout(){
        Session::destroySession();
      Response::redirectUrl("securite/login");
    }

    
}
