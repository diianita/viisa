<?php

class Page {
    static $site_url = "";    
    static $base_path = "";
    static $dbhost = "";
    static $dbname = "";
    static $dbuser = "";
    static $dbpass = "";
    
    public function __construct() {}

    public static function loadClass($name = null) {
        $file = self::getBasePath() . '/classes/class.' . $name . '.php';
        if (file_exists($file)) {
            require_once($file);
        }
    }

    public static function loadDB() {
        $file = self::getBasePath() . '/classes/class.MySQLi.php';
        if (file_exists($file)) {
            require_once($file);
        }
    }

    public static function loadConfig() {
        date_default_timezone_set('America/Bogota');
        $file = self::getBasePath() . '/conf/config.php';
        if (!file_exists($file)) {
        	$file = self::getBasePath() . '../conf/config.php';
        }
        
        if (file_exists($file)) {
            include ($file);
            
            self::$dbhost = $dbhost;
            self::$dbname = $dbname;
            self::$dbuser = $dbuser;
            self::$dbpass = $dbpass;
            
            $url = $siteURL;
            self::$base_path = BASE_PATH;

            if (strlen($url) > 0) {
                $siteURL = trim($url, "/");
                self::$site_url = $siteURL . "/";
            }
        }
    }

    public static function getUserId() {
        $returnValue = 0;
        if (isset($_SESSION["user_id"])) {
            $returnValue = $_SESSION["user_id"];
        }
        return $returnValue;
    }
    
    public static function getUrl() {
        if (isset(self::$site_url)) {
        	if(empty(self::$site_url)){
        		self::loadConfig();
        	}
            return self::$site_url;
        }
    }

    public static function getBasePath() {
        return dirname(__DIR__);
    }

    public static function parseRequestVariable($variable_name, $defaultValue = '') {
        eval('global $' . $variable_name . ';');
        $returnValue = $defaultValue;
        if (isset($_REQUEST[$variable_name])) {
            eval("$" . $variable_name . " = \$_REQUEST['" . $variable_name . "'];");
            $returnValue = $_REQUEST[$variable_name];
        } else {
            if (is_bool($defaultValue)) {
                eval("$" . $variable_name . ' = $defaultValue;');
            } else {
                eval("$" . $variable_name . " = '" . $defaultValue . "';");
            }
            $returnValue = $defaultValue;
        }
        return $returnValue;
    }

    public static function loadVars() {
        $init_values = array();
        $init_values['WEBSITE_URL'] = self::getUrl();
        $init_values['USER_ID'] = isset($_SESSION['id']) ? $_SESSION['id'] : FALSE;
        return $init_values;
    }
}
