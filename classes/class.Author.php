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
        $autor = $db->get("Autores as a", null, null);

        return $autor;
    }

    public function createAuthor($author) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $idAuthor = $db->insert('Autores', $author);

        if ($idAuthor) {
            return array("return" => true, "mensaje" => "Autor creado!");
        } else {
            //echo "mal 2";
            return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
        }
    }

}

?>