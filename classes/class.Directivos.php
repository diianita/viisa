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
        $users = $db->get("Usuario as u, Personal as p", null, null);

        return $users;
    }

    public function createDirectivo($usuario, $directivo) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');       
        $idUser = $db->insert('Usuario', $usuario);
        
        if ($idUser) {
            $data = Array("usuario" => $idUser, "descripcion" => $directivo);
            $idManager = $db->insert('Personal', $data);

            if ($idManager) {
                echo "bien";
                return array("return" => true, "mensaje" => "Directivo creado!");
            } else {
                echo "mal 2";
                return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
            }
        } else {
            echo "mal 1";
            return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
        }
    }

}

?>