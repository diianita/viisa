<?php

class Directivos {

    function __construct() {
        
    }

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
        $db->where("u.tipoUsuario", 1);
        $db->where("u.id", $user_id);
        $db->where("p.usuario", $user_id);
        $users = $db->getOne("Usuario as u, Personal as p", null, null);

        return $users;
    }
    
    public function createPeronal($data) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.usuario", $data['usuario']);
        $usuario = $db->get("Personal as a");

        if (count($usuario) > 0) {
            return array("return" => false, "mensaje" => "Hubo un error, el personal ya existe");
        } else {
            $idPersonal = $db->insert('Personal', $data);
            if ($idPersonal) {
                return array("return" => true, "mensaje" => "Personal creado!");
            } else {
                return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
            }
        }
    }
    
    public function updateDirectivo($id, $data) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where('usuario', $id);
        if ($db->update('Personal', $data)) {
            return array("return" => true, "mensaje" => "Directivo modificado!");
        } else {
            return array("return" => false, "mensaje" => "error de base de datos");
        }
    }
}

?>