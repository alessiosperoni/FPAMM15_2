<?php

class viewDescriptor {

    private $social;
    private $header;
    private $Navigation;
    private $contenuto;
    private $footer;
    private $titolo;
    private $token;
    private $pagina;
    private $contenuto2;
    
    const get = 'get';
    const post = 'post';
    public function __construct(){
    }
    //Metodi get
    public function getSocial(){return $this->social;}
    public function getHeader(){return $this->header;}
    public function getNavigation(){return $this->Navigation;}
    public function getContenuto(){return $this->contenuto;}
    public function getTitolo(){return $this->titolo;}
    public function getFooter(){return $this->footer;}
    public function getPagina(){return $this->pagina;}
    public function getContenuto2(){return $this->contenuto2;}
    //Metodi set
    public function setSocial($social){$this->social=$social;}
    public function setHeader($header){$this->header=$header;}
    public function setNavigation($navigation){$this->Navigation=$navigation;}
    public function setContenuto($contenuto){$this->contenuto=$contenuto;}
    public function setTitolo($titolo){$this->titolo=$titolo;}
    public function setFooter($footer){$this->footer=$footer;}
    public function setPagina($pagina){$this->pagina=$pagina;}
    public function setContenuto2($contenuto2){$this->contenuto2=$contenuto2;}
    
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
