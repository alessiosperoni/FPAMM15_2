<?php
include_once 'User.php';
class Developer extends User{
    
    /**
     * via residenza sviluppatore
     * @var type string
     */
    private $via;
    
    
    /**
     * provincia sviluppatore
     * @var type string
     */
    private $provincia;
    
    /**
     * CAP sviluppatore
     * @var type int
     */
    private $CAP;
    /**
     * Costruttore, setto il ruolo a Developer
     */
    public function __construct() {
        parent::__construct();
        parent::setRuolo(parent::Developer);
    }
    /**
     * Restituisce la via
     * @return string
     */
    public function getVia(){
        return $this->via;
    }
    
    /**
     * Restituisce il CAP
     * @return int
     */
    public function getCAP(){
        return $this->CAP;
    }
    
    /**
     * Restituisce la provincia
     * @return string
     */
    public function getProvincia(){
        return $this->provincia;
    }
    /**
     * Imposta la via
     * @param type $via
     */
    public function setVia($via){
        $this->via=$via;
    }
    /**
     * Imposta il codice d'avviamento postale 
     * @param type $CAP
     */
    public function setCAP($CAP){
        $this->CAP=$CAP;
    }
    /**
     * Imposta la provincia
     * @param type $provincia
     */
    public function setProvincia($provincia){
        $this->provincia=$provincia;
    }
    
}

