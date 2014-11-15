<?php

class Estudiante {

    function __construct() {
        
    }
    
    public function getEstudiante($user_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("u.tipoUsuario", 4);
        $db->where("u.id", $user_id);
        $db->where("e.usuario", $user_id);
        $users = $db->getOne("Usuario as u, Estudiante as e", null, null);

        return $users;
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
    
    public function updateEstudiante($id, $data) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where('usuario', $id);
        if ($db->update('Estudiante', $data)) {
            return array("return" => true, "mensaje" => "Estudiante modificado!");
        } else {
            return array("return" => false, "mensaje" => "error de base de datos");
        }
    }
}

?>