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