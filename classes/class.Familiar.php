<?php

class Familiar {

    function __construct() {
        
    }
    
    public function createFamiliar($data) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.usuario", $data['usuario']);
        $usuario = $db->get("Familiar as a");

        if (count($usuario) > 0) {
            return array("return" => false, "mensaje" => "Hubo un error, el familiar ya existe");
        } else {
            $idPersonal = $db->insert('Familiar', $data);
            if ($idPersonal) {
                return array("return" => true, "mensaje" => "Familiar creado!");
            } else {
                return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
            }
        }
    }
}

?>