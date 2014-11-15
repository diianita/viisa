<?php

class Estudiante {

    function __construct() {
        
    }
    
    public function createEstudiante($data) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.usuario", $data['usuario']);
        $usuario = $db->get("Estudiante as a");

        if (count($usuario) > 0) {
            return array("return" => false, "mensaje" => "Hubo un error, el estudiante ya existe");
        } else {
            $idPersonal = $db->insert('Estudiante', $data);
            if ($idPersonal) {
                return array("return" => true, "mensaje" => "Estudiante creado!");
            } else {
                return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
            }
        }
    }
}

?>