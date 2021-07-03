<?php
namespace gestion\lib;
use \gestion\controllers\ErreurController;
class Router{

    private Request $request;
    private ErreurController $ctlrError;

    public function  __construct(){
        $this-> request = new Request();
        $this-> ctlrError = new ErreurController();
    }

    Public  function resolve(){

        $array_uri = $this->request->getUri();
        if(empty($array_uri[0]) || !isset($array_uri[1]))Response::redirectUrl("securite/login");
        $action=$array_uri[1];
        if(strpos($action,"."))Response::redirectUrl("securite/login");
        $controller=ucfirst($array_uri[0])."Controller";
        if(file_exists(ROOT.DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR.$controller.".php")){
            $controllerClass= "gestion\\controllers\\".$controller;
            $objectController = new $controllerClass();
            if(method_exists($objectController,$action)){
                call_user_func([$objectController,$action],$this->request);
            }else{
                $this->ctlrError->pageNotFound();
              // echo(" method existe pas");
            }
        }else{
            $this->ctlrError->pageNotFound();
           // echo(" not found files");
        }
    
}
}