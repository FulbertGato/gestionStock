<?php
namespace gestion\controllers;
use \gestion\lib\AbstractController;

class ErreurController extends AbstractController {

    public function pageNotFound(){
        http_response_code(404);
        $this->render("erreur/404");

    }
    public function pageForbidden(){
        http_response_code(403);
        $this->render("erreur/403");
    }



    
}