<?php

class viewDescriptor {

    private $social;
    private $header;
    private $Navigation;
    private $contenuti;
    private $contenuto;
    private $footer;
    private $titolo;
    private $token;
    private $pagina;
    private $sottoPagina;
    
    const get = 'get';
    const post = 'post';
    public function __construct(){
        $this->contenuti = array();
    }
    //Metodi get
    public function getSocial(){return $this->social;}
    public function getHeader(){return $this->header;}
    public function getNavigation(){return $this->Navigation;}
    public function getContenuti(){return $this->contenuti;}
    public function getContenuto(){return $this->contenuto;}
    public function getTitolo(){return $this->titolo;}
    public function getFooter(){return $this->footer;}
    public function getPagina(){return $this->pagina;}
    public function getSottoPagina(){return $this->SottoPagina;}
    //Metodi set
    public function setSocial($social){$this->social=$social;}
    public function setHeader($header){$this->header=$header;}
    public function setNavigation($navigation){$this->Navigation=$navigation;}
    public function setContenuti($contenuti){$this->contenuti=$contenuti;}
    public function setContenuto($contenuto){$this->contenuto=$contenuto;}
    public function setTitolo($titolo){$this->titolo=$titolo;}
    public function setFooter($footer){$this->footer=$footer;}
    public function setPagina($pagina){$this->pagina=$pagina;}
    public function setSottoPagina($SottoPagina){$this->pagina=$SottoPagina;}
    
    //Add content
    public function addContenuto($contenuto, $i){$this->contenuti[$i]=$contenuto;}
    
    public function setToken($token){$this->token=$token;}

    /**
     * Scrittura del token
     * @param type $pre
     * @param type $method
     * @return string
     */
    public function scriviToken($pre = '', $method = self::get) {
        $noUser = BaseController::noUser;
        switch ($method) {
            case self::get:
                if (isset($this->token)) {
                    return $pre . "$noUser=$this->token";
                }
                break;
            case self::post:
                if (isset($this->token)) {
                    return "<input type=\"hidden\" name=\"$noUser\" value=\"$this->token\"/>";
                }
                break;
        }
        return '';
    }
    
    
}
