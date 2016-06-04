<?php 
    
    include_once 'Controller/controllerBase.php'; 
    include_once 'Controller/controllerUser.php'; 
    
    
    
    date_default_timezone_set("Europe/Rome");
    FrontController::dispatch($_REQUEST);
    
    class FrontController{
        public static function dispatch(&$request){
            session_start();
            if(isset($request["page"])){
                switch ($request["page"]) {
                    case "login":
                        $controllo = new ControllerBase();
                        $controllo->handleInput($request);
                        break;
                    case "user":
                        $controllo = new ControllerUser();
                        if (isset($_SESSION[ControllerBase::ruolo]) 
                            && $_SESSION[ControllerBase::ruolo] 
                            != User::User){}
                        $controllo->handleInput($request);
                        break;
                    case "developer":
                        $controllo = new ControllerDeveloper();
                        if (isset($_SESSION[ControllerBase::ruolo]) 
                            && $_SESSION[ControllerBase::ruolo] 
                            != User::Developer){}
                        $controllo->handleInput($request);
                        break;

                    default:
                        break;
                }
            }
        }
    }
    
?>
    
