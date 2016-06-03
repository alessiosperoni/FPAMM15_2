<?php

include_once basename(__DIR__) . '/../View/viewDescriptor.php';
include_once basename(__DIR__) . '/../Model/User.php';
include_once basename(__DIR__) . '/../Model/UserFactory.php';

/**
 * Controller che gestisce gli utenti non autenticati, 
 * fornendo le funzionalita' comuni anche agli altri controller
 *
 * @author Alessio Speroni
 */
class ControllerBase {

    const user = 'user';
    const ruolo = 'ruolo';
    const noUser = '_nouser';
    /**
     * Costruttore
     */
    public function __construct() {
        
    }
    
     /**
     * Metodo per gestire l'input dell'utente. Le sottoclassi lo sovrascrivono
     * @param type $request la richiesta da gestire
     */
    public function handleInput(&$request) {
        // creo il descrittore della vista
        $vd = new ViewDescriptor();
        
        // imposto la pagina
        $vd->setPagina($request['page']);

        $this->setImpostaToken($vd, $request);
        
        if (isset($request["cmd"])) {
            
            switch ($request["cmd"]) {
                //login 
                case 'index.php?page=login':
                    $this->showLogin($vd);
                    $username = isset($request['user']) ? $request['user'] : '';
                    $password = isset($request['password']) ? $request['password'] : '';
                    // eseguo login
                    $this->login($vd, $username, $password);
                    // imposto dati utente
                    if($this->loggedIn()) {
                        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);   
                    }
                    
                    break;
                case 'logout':
                    $this->logout($vd);
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
    
    /**
     * imposto il token per impersonare eventualmente l'utente
     * @param viewDescriptor $vd 
     * @param array $request 
     */
    protected function setImpostaToken(viewDescriptor $vd, &$request) {

        if (array_key_exists('_impost', $request)) {
            $vd->setImpToken($request['_impost']);
        }
    }

    /**
     * Controllo di logged in
     * @return type boolean
     */
    protected function loggedIn() {
        return isset($_SESSION) && array_key_exists("user", $_SESSION);
    }
    
    protected function showLogin($vd){
        $vd->setTitolo("Login");
        $vd->setContenuto('login/formLogin.php');
        $vd->setFooter('footer.php');
        $vd->setSocial('social.php');
        $vd->setHeader('header.php');
        $vd->setNavigation('Navigation.php');
    }  
    
    protected function showUserHome($vd){
        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
        $vd->setTitolo("Home Utente");
        $vd->setContenuto('User/contenutoDatiUtente.php');
        $vd->setFooter('footer.php');
        $vd->setSocial('social.php');
        $vd->setHeader('header.php');
        $vd->setNavigation('User/Navigation.php');
    }  
    
    
    public function login($vd, $username, $password){
        
        $user = UserFactory::instance()->UserFromDatabase($username, $password);
        if (isset($user) && $user->esiste()) {
            $_SESSION[self::user] = $user->getId();
            $_SESSION[self::ruolo] = $user->getRuolo();
            $this->showUserHome($vd);
        }else{
            echo 'Nome utente o Password errati, riprovare';
            $this->showLogin($vd);
        }
        
    }
    
    /**
     * Termina sessione e mostra login
     * @param type $vd
     */
    protected function logout($vd) {
        $_SESSION = array();
        if (session_id() != '' || isset($_COOKIE[session_name()])) {
            
            setcookie(session_name(), '', time() - 2592000, '/');
        }
        session_destroy();
        
        $this->showLogin($vd);
    }
    
}