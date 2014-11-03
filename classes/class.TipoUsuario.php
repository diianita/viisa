<?php

class TipoUsuario {

    function __construct() {
        
    }

    public function getTipoUsuarios() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $tipoUsuarios = $db->rawQuery('SELECT * from TipoUsuario as a where enabled=1', null);

        return $tipoUsuarios;
    }
    
    public function getTotalTipoUsuarios($book_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $tipoUsuarios = $db->rawQuery('SELECT count(*) as total from TipoUsuario as a where enabled=1', null);

        return $tipoUsuarios[0]['total'];
    }

    public function getTipoUsuario($tipoUsuario_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $tipoUsuario_id);
        $tipoUsuario = $db->get("TipoUsuario as a", null, null);

        return $tipoUsuario;
    }

    public function createTipoUsuario($tipoUsuario) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $idTipoUsuario = $db->insert('TipoUsuario', $tipoUsuario);

        if ($idTipoUsuario) {
            return array("return" => true, "mensaje" => "TipoUsuario creado!");
        } else {
            //echo "mal 2";
            return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
        }
    }

}

?>