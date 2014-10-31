<?php

class Directivos{

    function __construct() {}

    public function getDirectivos() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        //$db->where ("u.tipoUsuario", 1);
        //$db->where ("u.id", "p.usuario");
        //$users = $db->get("Usuario as u, Personal as p", null, null);
        $users = $db->rawQuery('SELECT * from Usuario as u, Personal as p where u.tipoUsuario=? and u.id=p.usuario', array(1), null);
        
        return $users;
    }

    public function getDirectivo($user_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where ("u.tipoUsuario", 1);
        $db->where ("u.id", $user_id);
        $users = $db->get("Usuario as u, Personal as p", null, null);
        
        return $users;
    }
}

?>