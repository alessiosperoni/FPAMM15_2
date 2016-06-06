<?php

include_once 'controllerBase.php';

class ControllerDeveloper extends ControllerUser {
    static $idProdotto=1;
    
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
                    if (UserFactory::instance()->salva($user) == 0) {
                        echo '<p class="messaggio">Nessun dato aggiornato</p>';   
                    }
                    $this->showDeveloperHome($vd);
                    break;
                case 'newProdotto':
                    $this->showCreaProdotto($vd);
                    //echo 'deb1: pre creaProdotto___';
                    //echo $request['nomeProdotto'];
                    //if(isset($request['nomeProdotto'])){
                    //$prodotto = ProdottoFactory::instance()->creaProdotto($request);//}
                    $prodotto = new Prodotto();
                    //echo 'deb2: post creaProdotto___';
                    break;
                case 'addCode':
                    $prodotto = ProdottoFactory::instance()->creaProdotto($request);
                    ProdottoFactory::instance()->salva($prodotto);
                    ControllerDeveloper::$idProdotto=$prodotto->getId();
                    
                    $prodotto = ProdottoFactory::instance()->cercaProdottoPerId(ControllerDeveloper::$idProdotto);
                    $this->showProdotto($vd);
                    break;
                case 'chiSiamo':
                    $this->showChiSiamo($vd);
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
        $vd->setTitolo("Home Sviluppatore");
        $vd->setContenuto('Developer/contenutoDatiSviluppatore.php');
        $vd->setFooter('footer.php');
        $vd->setSocial('social.php');
        $vd->setHeader('header.php');
        $vd->setNavigation('Developer/Navigation.php');
    } 
    protected function showModificaDati($vd){
        $vd->setTitolo("Modifica dati sviluppatore");
        $vd->setContenuto('Developer/formModificaDati.php');
        $vd->setFooter('footer.php');
        $vd->setSocial('social.php');
        $vd->setHeader('header.php');
        $vd->setNavigation('Developer/Navigation.php');
    }  
    protected function showCreaProdotto($vd){
        $vd->setTitolo("Crea Nuovo Prodotto");
        $vd->setContenuto('Developer/addProdotto.php');
        $vd->setFooter('footer.php');
        $vd->setSocial('social.php');
        $vd->setHeader('header.php');
        $vd->setNavigation('Developer/Navigation.php');
    } 
    protected function showProdotto($vd){
        $vd->setTitolo("Prodotto");
        $vd->setContenuto('Developer/contenutoProdotto.php');
        $vd->setFooter('footer.php');
        $vd->setSocial('social.php');
        $vd->setHeader('header.php');
        $vd->setNavigation('Developer/Navigation.php');
    } 
    protected function showChiSiamo($vd) {
        $vd->setTitolo("Chi siamo");
        $vd->setContenuto('chiSiamo.php');
        $vd->setFooter('footer.php');
        $vd->setSocial('social.php');
        $vd->setHeader('header.php');
        $vd->setNavigation('Developer/Navigation.php');
    }
    
}