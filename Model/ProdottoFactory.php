<?php
include_once 'Prodotto.php';
class ProdottoFactory{
    
    public function __construct() {
        
    }
    public function instance() {
        return new ProdottoFactory();
    }
    /**
     * 
     * @param type int
     * @param type string
     * @return type Prodotto
     */
    public function cercaProdottoPerId($id) {
        $intval = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }
        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        $query = "select  
        Prodotto.nome nome,
        Prodotto.modello modello,
        Prodotto.data data,
        Prodotto.produttore_id produttore_id,
        Prodotto.descrizione descrizione
        from Prodotto
        where Prodotto.id = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $intval)) {
            error_log("Impossibile effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        return self::caricaProdotto($stmt);
    }
    
    /**
     * 
     * @param mysqli_stmt $stmt
     * @return type Prodotto
     */
    public function caricaProdotto(mysqli_stmt $stmt) {
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            return null;
        }
        $row = array();
        $bind = $stmt->bind_result(
                $row['nome'],
                $row['modello'],
                $row['data'],
                $row['produttore_id'],
                $row['descrizione']);
        if (!$bind) {
            error_log("Impossibile effettuare il binding in output");
            return null;
        }
        if (!$stmt->fetch()) {
            return null;
        }
        $stmt->close();
        return self::creaProdotto($row);
    }
    
    public function creaProdotto($request) {
        $prodotto = new Prodotto();
        //if(isset($request['nomeProdotto'])){
        $prodotto->setNome($request['nome']);//}
        //if(isset($request['modelloProdotto'])){
        $prodotto->setModello($request['modello']);//}
        //if(isset($request['data'])){
        $prodotto->setData($request['data']);//}
        //if(isset($request['produttore_id'])){
        $prodotto->setProduttore_id($request['produttore_id']);//}
        //if(isset($request['descrizione'])){
        $prodotto->setDescrizione($request['descrizione']);//}
        
        return $prodotto;
    }
    
    /**
     * Funzione principale salvataggio prodotto
     * @param User $utente
     * @return int
     */
    public function salva(Prodotto $prodotto){
        echo 'Im trying to saving_id_Prodotto=';
        $mysqli = Database::getInstance()->connectDb();
        if(!isset($mysqli)){
            error_log("Impossibile creare database ");
            $mysqli->close();
            return 0;
        }
        $query = "select max(id) massimo from Prodotto;";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if(!$stmt){
            error_log("Impossibile inizializzare il prepared statement");
            return 0; 
        }/**********************************************************************************************************/
        
        if(!$stmt->execute()){
            error_log("fallita esecuzione statement");
            return 0;
        }
        $row = array();
        $bind = $stmt->bind_result(
                $row['massimo']);
        if (!$stmt->fetch()) {
            return null;
        }
        $prodotto->setId($bind+1);
        echo $prodotto->getId();
        echo '_maxId=';
        echo $bind;
        $query = "INSERT INTO `Prodotto`
                (`id`, `nome`, `modello`, `data`, `produttore_id`, `descrizione`) 
                VALUES (?,?,?,?,?,?);";
        $stmt->prepare($query);
        if(!$stmt){
            error_log("Impossibile inizializzare il prepared statement");
            return 0; 
        }        
        if(!$stmt->bind_param('isssis',
                $prodotto->getId(),
                $prodotto->getNome(),
                $prodotto->getModello(),
                $prodotto->getData(),
                $prodotto->getProduttore_id(),
                $prodotto->getDescrizione()
                )){
            error_log("binding in input fallito");
            return 0;
        }
        if(!$stmt->execute()){
            error_log("fallita esecuzione statement");
            return 0;
        }
        if (!$stmt->fetch()) {
            return 0;
        }
        $stmt->close();
        $mysqli->close();
        return $prodotto->getId();
    }
}