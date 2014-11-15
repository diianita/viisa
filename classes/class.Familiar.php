<?php

class Familiar {

    function __construct() {
        
    }
    
    public function getFamiliar($user_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("u.tipoUsuario", 5);
        $db->where("u.id", $user_id);
        $db->where("f.usuario", $user_id);
        $users = $db->getOne("Usuario as u, Familiar as f", null, null);

        return $users;
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
    
    public function updateFamiliar($id, $data) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where('usuario', $id);
        if ($db->update('Familiar', $data)) {
            return array("return" => true, "mensaje" => "familiar modificado!");
        } else {
            return array("return" => false, "mensaje" => "error de base de datos");
        }
    }
}

?>