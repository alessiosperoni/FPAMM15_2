<?php
class User {
    
    
    private $ruolo;
    const User = 1;
    const Developer = 2;
    /**
     * nome utente
     * @var string
     */
    private $username;
    
    /**
     * password
     * @var string
     */
    private $password;
    
    /**
     * Nome dell'utente
     * @var string
     */
    private $nome;
    
    /**
     * Cognome dell'utente
     * @var string 
     */
    private $cognome;
    
    /** 
     * email dell'utente
     * @var string
     */
    private $email;
    
    /**
     * citta di residenza
     * @var string
     */
    private $citta;
    
    /**
     * Identificatore univoco
     * @var int
     */
    private $id;
    
    public function __construct() {}
    
    //Implemento i metodi get per tutte le variabili 
    /**
     * restituisce username
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }
    /**
     * restituisce nome utente
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }
    /**
     * restituisce cognome utente
     * @return string
     */
    public function getCognome() {
        return $this->cognome;
    }
    /**
     * restituisce email
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }
    /**
     * restituisce la citta 
     * @return string
     */
    public function getCitta() {
        return $this->citta;
    }
    /**
     * restituisce l'identificativo dell'utente
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Restituisce il ruolo dell'utente
     * @return int
     */
    public function getRuolo(){
        return $this->ruolo;
    }
    /**
    * Restituisce la password dell'utente
    * @return int
    */
    public function getPassword(){
        return $this->password;
    }

    //Implemento i metodi set con relativi controlli servendomi della funzione filter_var
    
    
    /**
     * Setta l'username a patto che i caratteri siano accettati (solo lettere e lunghezza>5)
     * @param type $username
     * @return boolean
     */
    public function setUsername($username){
        if (!filter_var($username, FILTER_VALIDATE_REGEXP, 
                array('options' => array('regexp' => '/[a-zA-Z]{5,}/')))) {
            return false;
        }
        $this->username = $username;
        return true;
    }
    /**
     * 
     * @param type $password
     * @return boolean
     */
    public function setPassword($password){
        $this->password = $password;
        return true;
    }
    /**
     * 
     * @param type $nome
     * @return boolean
     */
    public function setNome($nome){
        $this->nome = $nome;
        return true;
    }
    /**
     * 
     * @param type $cognome
     * @return boolean
     */
    public function setCognome($cognome){
        $this->cognome = $cognome;
        return true;
    }
    /**
     * 
     * @param type $email
     * @return boolean
     */
    public function setEmail($email){
        $this->email = $email;
        return true;
    }
    /**
     * 
     * @param type $citta
     * @return boolean
     */
    public function setCitta($citta){
        $this->citta = $citta;
        return true;
    }
    /**
     * 
     * @param type $id
     * @return boolean
     */
    public function setId($id){
        $this->id = $id;
        return true;
    }
    /**
     * 
     * @param type $ruolo
     * @return boolean
     */
    public function setRuolo($ruolo){
        $this->ruolo = $ruolo;
        return true;
    }
    
    
    public function equals(User $user) {
        return  $this->id == $user->id;
    }
    
    public function esiste(){
        return isset($this->ruolo);
    }
    
}
