<?php

class Author {

    function __construct() {
        
    }

    public function getAutores() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $autores = $db->rawQuery('SELECT * from Autores as a where enabled=1', null);

        return $autores;
    }

    public function getAuthor($autor_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $autor_id);
        $autor = $db->getOne("Autores as a", null, null);

        return $autor;
    }

    public function createAuthor($author) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $idAuthor = $db->insert('Autores', $author);

        if ($idAuthor) {
            return array("return" => true, "mensaje" => "Autor creado!");
        } else {
            return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
        }
    }

    public function updateAuthor($id, $nombre) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where('id', $id);

        $data = Array('nombre' => $nombre);
        if ($db->update('Autores', $data)) {
            return array("return" => true, "mensaje" => "Autor modificada");
        } else {
            return array("return" => false, "mensaje" => "update failed: " . $db->getLastError());
        }
    }

    public function disableAuthor($id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');

        $prestamos = $db->rawQuery('SELECT count(*) from Libro as l, Ejemplares as e, Prestamo as p where l.autor=' . $id . ' and l.id = e.libro and e.id = p.ejemplar', null);
        if ($prestamos[0]['count(*)'] == 0) {
            $db->where('id', $id);
            $data = Array('enabled' => 0);
            if ($db->update('Autores', $data)) {
                return array("success" => true, "mensaje" => "autor modificada");
            } else {
                return array("success" => false, "mensaje" => "error en la base de datos");
            }
        } else {
            return array("success" => false, "mensaje" => "existen libros en prestamo");
        }
    }
}

?>