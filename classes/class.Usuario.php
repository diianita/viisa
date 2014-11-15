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
    
    public function getFamiliares() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $familiares = $db->rawQuery('SELECT *, f.id as id_familiar, u.id as id_usuario from Familiar as f, Usuario as u where f.usuario = u.id and u.enabled=1 order by f.id', null);

        return $familiares;
    }

    public function getUsuario($usuario_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $usuario_id);
        $usuario = $db->getOne("Usuario as a", null, null);

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

    public function createUsuario($data) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.email", $data['email']);
        $usuario = $db->get("Usuario as a");

        if (count($usuario) > 0) {
            return array("return" => false, "mensaje" => "Hubo un error, el usuario ya existe.");
        } else {
            $idUsuario = $db->insert('Usuario', $data);
            if ($idUsuario) {
                return array("return" => true, "mensaje" => "Usuario creado!", "id" => $idUsuario);
            } else {
                return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
            }
        }
    }

    public function updateUsuario($id, $data) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where('id', $id);

        if ($db->update('Usuario', $data)) {
            return array("return" => true, "mensaje" => "usario modificado!");
        } else {
            return array("return" => false, "mensaje" => "error de base de datos");
        }
    }

    public function disableUsuario($id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $prestamos = $db->rawQuery('SELECT count(*) from Prestamo as p where p.usuario = ' . $id . '', null);

        if ($prestamos[0]['count(*)'] == 0) {
            $db->where('id', $id);
            $data = Array('enabled' => 0);
            if ($db->update('Usuario', $data)) {
                return array("success" => true, "mensaje" => "Usuario modificado");
            } else {
                return array("success" => false, "mensaje" => "error en la base de datos");
            }
        } else {
            return array("success" => false, "mensaje" => "Hubo un error, el usuario tiene libros en prestamo");
        }
    }

}

?>