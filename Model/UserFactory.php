<?php

    include_once 'Database.php';
    include_once 'User.php';
    include_once 'Developer.php';
    
class UserFactory {
    
    private static $singleton;
    /**
     * Costruttore
     */
    private function __construct() {
    }
    /**
     * Creo funzione per creare istanza di questa classe
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new UserFactory();}
        return self::$singleton;}
        
    /**
     * 
     * @param type int
     * @param type string
     * @return type User
     */
    public function cercaUtentePerId($id,$ruolo) {
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
        switch ($ruolo) {
            // cerco prima su un utente sviluppatore
            case User::Developer: 
                $query = "select  
                user.username username,
                user.password password,
                user.nome nome,
                user.cognome cognome,	
                user.email email,
                user.citta citta,
                user.id id,
                user.ruolo ruolo,
                developer.provincia,
                developer.via,
                developer.CAP
                from user
                LEFT JOIN developer
                ON user.id=developer.id 
                where user.id = ?";
                
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
                
                return self::caricaDeveloper($stmt);
            
            // cerco un utente non sviluppatore
            case User::User:
                $query = "select  
                user.username username,
                user.password password,
                user.nome nome,
                user.cognome cognome,	
                user.email email,
                user.citta citta,
                user.id id,
                user.ruolo ruolo,
                developer.provincia,
                developer.via,
                developer.CAP
                from user
                LEFT JOIN developer
                ON user.id=developer.id 
                where user.id = ?";

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

                $toRet =  self::caricaUser($stmt);
                $mysqli->close();
                return $toRet;

            default: 
                return null;
        }
    }
    
    public function userFromDatabase($username, $password){
        
        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        $query = "select  
                user.username username,
                user.password password,
                user.nome nome,
                user.cognome cognome,	
                user.email email,
                user.citta citta,
                user.id id,
                user.ruolo ruolo,
                developer.provincia,
                developer.via,
                developer.CAP
                from user
                LEFT JOIN developer
                ON user.id=developer.id 
                where username = ?
                AND password = ?";
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }
        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("binding fallito");
            $mysqli->close();
            return null;
        }
        
        $utente = self::caricaUser($stmt);
        if (isset($utente)) {
            $mysqli->close();
            return $utente;
        }
        
        
    }
    
    
    /**
     * 
     * @param mysqli_stmt $stmt
     * @return type User
     */
    public function caricaUser(mysqli_stmt $stmt) {
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            return null;
        }
        $row = array();
        $bind = $stmt->bind_result(
                $row['username'],
                $row['password'],
                $row['nome'],
                $row['cognome'],
                $row['email'],
                $row['citta'],
                $row['id'],
                $row['ruolo'],
                $row['provincia'],
                $row['via'],
                $row['CAP']);
        if (!$bind) {
            error_log("Impossibile effettuare il binding in output");
            return null;
        }
        if (!$stmt->fetch()) {
            return null;
        }
        $stmt->close();
        return self::creaUser($row);
    }
    
    
    private function caricaDeveloper(mysqli_stmt $stmt) {
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            return null;
        }
        $row = array();
        $bind = $stmt->bind_result(
                $row['username'],
                $row['password'],
                $row['nome'],
                $row['cognome'],
                $row['email'],
                $row['citta'],
                $row['id'],
                $row['ruolo'],
                $row['provincia'],
                $row['via'],
                $row['CAP']);
        if (!$bind) {
            error_log("Impossibile effettuare il binding in output");
            return null;
        }
        if (!$stmt->fetch()) {
            return null;
        }
        $stmt->close();
        return self::creaDeveloper($row);
    }
    
    
    
    public function creaUser($row) {
        
        $utente = new User();
        $utente->setUsername($row['username']);
        $utente->setPassword($row['password']);
        $utente->setNome($row['nome']);
        $utente->setCognome($row['cognome']);
        $utente->setEmail($row['email']);
        $utente->setCitta($row['citta']);
        $utente->setId($row['id']);
        $utente->setRuolo($row['ruolo']);
        
        
        return $utente;
    }
    public function creaDeveloper($row) {
        
        $utente = new Developer();
        $utente->setUsername($row['username']);
        $utente->setPassword($row['password']);
        $utente->setNome($row['nome']);
        $utente->setCognome($row['cognome']);
        $utente->setEmail($row['email']);
        $utente->setCitta($row['citta']);
        $utente->setId($row['id']);
        $utente->setRuolo($row['ruolo']);
        $utente->setProvincia($row['provincia']);
        $utente->setVia($row['via']);
        $utente->setCAP($row['CAP']);
        
        
        
        return $utente;
    }
    
    
    
    /**
     * Funzione principale salvataggio modifiche user
     * @param User $utente
     * @return int
     */
    public function salva(User $utente){
        $mysqli = Database::getInstance()->connectDB();
        if(!isset($mysqli)){
            error_log("Impossibile creare database ");
            $mysqli->close();
            return 0;
        }
        
        $stmt = $mysqli->stmt_init();
        $conta=0;
        switch ($utente->getRuolo()) {
            case User::User:
                $conta=$this->salvaUser($utente, $stmt);
                break;
            case User::Developer:
                $conta=$this->salvaDeveloper($utente, $stmt);
                break;
            default:
                error_log("Errore: salvataggio utente non eseguito");
                break;
            
        }
        
        $stmt->close();
        $mysqli->close();
        return $conta;
        
    }
    /**
     * Funzione specifica modifiche user
     * @param User $utente
     * @param mysqli_stmt $stmt
     * @return int
     */
    private function salvaUser(User $utente, mysqli_stmt $stmt){
        
        $query= "update User set
                nome = ?,
                cognome = ?,
                citta = ?, 
                username = ?,
                password = ?,
                email = ?,
                ruolo = ?,
                where User.id = ?
                ";
        $stmt->prepare($query);
        if(!$stmt){
            error_log("Impossibile inizializzare il prepared statement");
            return 0; 
        }
        if(!$stmt->bind_param("ssssssii",
                $utente->getNome(),
                $utente->getCogname(),
                $utente->getCitta(),
                $utente->getUsername(),
                $utente->getPassword(),
                $utente->getEmail(),
                $utente->getRuolo(),
                $utente->getId()
                )){
            error_log("binding in input fallito");
            return 0;
        }
        if(!$stmt->execute()){
            error_log("fallita esecuzione statement");
            return 0;
        }
        return $stmt->affected_rows;
    }
    
    /**
     * Funzione specifica modifiche Developer
     * @param User $utente
     * @param mysqli_stmt $stmt
     * @return int
     */
    private function salvaDeveloper(Developer $Developer, mysqli_stmt $stmt){
        
        $query= "update user set
                nome = ?,
                cognome = ?,
                citta = ?, 
                username = ?,
                password = ?,
                email = ?,
                ruolo = ?
                where user.id = ?;

                update developer set 
                provincia = ?,
                CAP = ?,
                via = ?
                where developer.id = ?
                ";
        $stmt->prepare($query);
        if(!$stmt){
            error_log("Impossibile inizializzare il prepared statement");
            return 0; 
        }
        if(!$stmt->bind_param("ssssssiisisi",
                $utente->getNome(),
                $utente->getCogname(),
                $utente->getCitta(),
                $utente->getUsername(),
                $utente->getPassword(),
                $utente->getEmail(),
                $utente->getRuolo(),
                $utente->getId(),
                $utente->getProvincia(),
                $utente->getCAP(),
                $utente->getVia(),
                $utente->getId()
                )){
            error_log("binding in input fallito");
            return 0;
        }
        if(!$stmt->execute()){
            error_log("fallita esecuzione statement");
            return 0;
        }
        return $stmt->affected_rows;
    }
    
    
    
}