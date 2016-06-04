<?php

include_once 'controllerBase.php';

class ControllerDeveloper extends ControllerUser {
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
                case 'homeDeveloper':
                    if($this->loggedIn()) {
                        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
                        $this->showDeveloperHome($vd);
                    }
                    else {
                        $this->showLogin($vd);
                        $username = isset($request['user']) ? $request['user'] : '';
                        $password = isset($request['password']) ? $request['password'] : '';
                        // eseguo login
                        $this->login($vd, $username, $password);
                        if($this->loggedIn()) {
                            $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
                            $this->showDeveloperHome($vd);
                        }
                    }
                    break;
                case 'modifica':
                    if($this->loggedIn()) {
                        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
                        $this->showModificaDati($vd);
                    }
                    break;
                case 'salva':
                    $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
                    if(isset($request['nomeUtente'])){
                        $user->setNome($request['nomeUtente']);
                    }
                    if(isset($request['cognomeUtente'])){
                        $user->setCognome($request['cognomeUtente']);
                    }
                    if(isset($request['email'])){
                        $user->setEmail($request['email']);
                    }
                    if (UserFactory::instance()->salva($user) != 1) {
                        echo '<p class="messaggio">Nessun dato aggiornato</p>';   
                    }
                    $this->showDeveloperHome($vd);
                    break;
                default : $this->showDeveloperHome($vd);
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
    protected function showDeveloperHome($vd){
        $vd->setTitolo("Home Utente");
        $vd->setContenuto('Developer/contenutoDatiSviluppatore.php');
        $vd->setFooter('footer.php');
        $vd->setSocial('social.php');
        $vd->setHeader('header.php');
        $vd->setNavigation('Developer/Navigation.php');
    } 
    protected function showModificaDati($vd){
        $vd->setTitolo("Modifica dati utente");
        $vd->setContenuto('Developer/formModificaDati.php');
        $vd->setFooter('footer.php');
        $vd->setSocial('social.php');
        $vd->setHeader('header.php');
        $vd->setNavigation('Developer/Navigation.php');
    } 
    
}