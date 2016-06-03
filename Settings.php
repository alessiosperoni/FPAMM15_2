<?php

/**
 * @author Alessio Speroni
 */
class Settings {

    // variabili di accesso per il database
    public static $db_host = 'localhost';
    public static $db_user = 'root';
    public static $db_password = 'alessio';
    public static $db_name='easyparking';
    

    private static $appPath='/amm2015/speroniAlessio/FPAMM15/';

    public static function getApplicationPath() {
        if (!isset(self::$appPath)) {
            // restituisce il server corrente
            switch ($_SERVER['HTTP_HOST']) {
                case 'localhost':
                    // configurazione locale
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/FPAMM15/';
                    break;
                case 'spano.sc.unica.it':
                    // configurazione pubblica
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm2015/speroniAlessio/FPAMM15/';
                    break;

                default:
                    self::$appPath = '';
                    break;
            }
        }
        
        return self::$appPath;
    }

}

?>
