<?php

class Directivos{

    function __construct() {}

    public function getDirectivos() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where ("tipoUsuario", 1);
        $users = $db->get("Usuario", null, null);
        
        return $users;
    }

}

?>