<?php
class Prodotto {
    /** 
     * nome
     * modello
     * data
     * produttore_id
     * descrizione
     * id
     */
    
    /************************/
    
    /**
     * nome prodotto
     * @var string
     */
    private $nome;
    
    /**
     * modello del prodotto
     * @var string
     */
    private $modello;
    /**
     * data produzione
     * @var string
     */
    private $data;
    
    /**
     * descrizione breve
     * @var string
     */
    private $descrizione;
    /**
     * identificativo del produttore
     * @var string
     */
    private $produttore_id;
    
    /**
     * id del prodotto
     * @var int
     */
    private $id;
    //Costruttore
    public function __construct() {}
    
    //implemento i set
    public function setId($id) {
        $this->id=$id;
        return true;
    }
    public function setNome($nome) {
        $this->nome=$nome;
        return true;
    }
    public function setModello($modello) {
        $this->modello=$modello;
        return true;
    }
    public function setData($data) {
        $this->data=$data;
        return true;
    }
    public function setProduttore_id($produttore_id) {
        $this->produttore_id=$produttore_id;
        return true;
    }
    public function setDescrizione($descrizione) {
        $this->descrizione=$descrizione;
        return true;
    }
    
    
    
    //Implemento i metodi get per tutte le variabili 
    /**
     * restituisce nome
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }
    /**
     * restituisce modello
     * @return string
     */
    public function getModello() {
        return $this->modello;
    }
    /**
     * restituisce data creazione
     * @return string
     */
    public function getData() {
        return $this->data;
    }
    /**
     * restituisce idProduttore
     * @return string
     */
    public function getProduttore_id() {
        return $this->produttore_id;
    }
    /**
     * restituisce descrizione breve
     * @return string
     */
    public function getDescrizione() {
        return $this->descrizione;
    }
    /**
     * restituisce id prodotto
     * @return string
     */
    public function getId() {
        return $this->id;
    }

}
?>