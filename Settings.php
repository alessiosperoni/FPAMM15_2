<?php

/**
 * @author Alessio Speroni
 */
class Settings {

    // variabili di accesso per il database
    public static $db_host = 'spano.sc.unica.it/';
    public static $db_user = 'speroniAlessio';
    public static $db_password = 'scorpione3318';
    public static $db_name='amm15_speroniAlessio';
    

    private static $appPath='/amm2015/speroniAlessio/FPAMM15_2/';

    public static function getApplicationPath() {
        if (!isset(self::$appPath)) {
            // restituisce il server corrente
            switch ($_SERVER['HTTP_HOST']) {
                case 'localhost':
                    // configurazione locale
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/FPAMM15_2/';
                    break;
                case 'spano.sc.unica.it':
                    // configurazione pubblica
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm2015/speroniAlessio/FPAMM15_2/index.php';
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
