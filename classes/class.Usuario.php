<?php
@session_start();
class Usuario {

    function __construct() {
        
    }

    public function getUsuarios() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $usuarios = $db->rawQuery('SELECT *, a.id as idu from Usuario as a, TipoUsuario as tu where a.TipoUsuario=tu.id and a.enabled=1 order by a.id', null);

        return $usuarios;
    }

    public function getUsuario($usuario_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $usuario_id);
        $usuario = $db->get("Usuario as a", null, null);

        return $usuario;
    }

    public function login($u, $password) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.email", $u);
        $db->where("a.contrasena", $password);
        $usuario = $db->get("Usuario as a");
       
        if (count($usuario) > 0) {
            $_SESSION['tipoUsuario'] = $usuario[0]['tipoUsuario'];
            $_SESSION['email'] = $usuario[0]['email'];
            $_SESSION['id'] = $usuario[0]['id'];

            $result = TRUE;
        } else {
            $result = FALSE;
        }
        return $result;
    }

    public function createUsuario($author) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $idUsuario = $db->insert('Usuario', $author);

        if ($idUsuario) {
            return array("return" => true, "mensaje" => "Usuario creado!");
        } else {
            //echo "mal 2";
            return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
        }
    }

}

?>