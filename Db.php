<?php
include_once 'Settings.php';


/**
 *  Il database
 * @author Alessio Speroni
 */
class Db {
    
    private function __construct() {
        
    }
    
    private static $singleton;
    /**
     *  Restituisce un singleton per la connessione al Db
     * @return \Db
     */
    public static function getInstance(){
        if(!isset(self::$singleton)){
            self::$singleton = new Db();
        }
        
        return self::$singleton;
    }
    
    /**
     * @return \mysqli una connessione al db 
     * restituisce null in caso di errore 
     */
    public function connectDb(){
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user,
        Settings::$db_password, Settings::$db_name);
        if($mysqli->errno != 0){
            return null;
        }else{
            return $mysqli;
        }
    }
}

?>
