<?php

include_once 'controllerBase.php';
//include_once basename(__DIR__) . '/../model/CorsiFactory.php';
//include_once basename(__DIR__) . '/../model/IscrizioneFactory.php';

class ControllerUser extends ControllerBase {
    public function __construct() {
        parent::__construct();
    }
    
    public function handleInput(&$request) {
        // creo il descrittore della vista
        $vd = new ViewDescriptor();
        
        // imposto la pagina
        $vd->setPagina($request['page']);

        $this->setImpostaToken($vd, $request);
        
        if (isset($request["cmd"])) {
            
            switch ($request["cmd"]) {
                // richiesta di login 
                case 'homeUser':
                    if($this->loggedIn()) {
                        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
                        $this->showUserHome($vd);
                    }
                    else {
                        $this->showLogin($vd);
                        $username = isset($request['user']) ? $request['user'] : '';
                        $password = isset($request['password']) ? $request['password'] : '';
                        // eseguo login
                        $this->login($vd, $username, $password);
                        if($this->loggedIn()) {
                            $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
                            $this->showUserHome($vd);
                        }
                    }
                    break;
                case 'index.php?user=homeUser':
                    $this->showUserHome($vd);
                    break;
                default : $this->showLogin($vd);
            }
        } else {
            if ($this->loggedIn()) {
                $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
                $this->showUserHome($vd);
            } else {
             
                $this->showLogin($vd);
            }
        }
        require  basename(__DIR__).'/../View/master.php';
        
    }
    protected function showUserHome($vd){
        $vd->setTitolo("Home Utente");
        $vd->setContenuto('User/contenutoDatiUtente.php');
        $vd->setFooter('footer.php');
        $vd->setSocial('social.php');
        $vd->setHeader('header.php');
        $vd->setNavigation('User/Navigation.php');
    } 
}