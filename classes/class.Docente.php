<?php

class Docente{

    function __construct() {}

    public function getDocentes() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $users = $db->rawQuery('SELECT * from Usuario as u, Personal as p where u.tipoUsuario=? and u.id=p.usuario', array(2), null);
        
        return $users;
    }

    public function getDocente($user_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where ("u.tipoUsuario", 2);
        $db->where ("u.id", $user_id);
        $users = $db->get("Usuario as u, Personal as p", null, null);
        
        return $users;
    }
}

?>