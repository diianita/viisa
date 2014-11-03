<?php

class Books {

    function __construct() {
        
    }

    public function getBooks($query = FALSE, $Params = false) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        if ($query) {
            if (count($Params) > 0) {
                switch ($Params['method']) {
                    case 'autor':
                        $Query = 'au.nombre like "%' . $query . '%"';
                        break;

                    case 'materia':
                        
                        $Query = 'm.nombre like "%' . $query . '%"';
                        break;

                    case 'codigo':
                        
                        $Query = 'e.codigo like "%' . $query . '%"';
                        break;

                    case 'nombre':
                        
                        $Query = 'a.nombre like "%' . $query . '%"';
                        break;

                    default:
                        
                        $Query = 'a.nombre like "%' . $query . '%"';
                        break;
                }
                $autores = $db->rawQuery('SELECT *, a.descripcion as descripcion_libro, a.nombre as nombre_libro, m.nombre as nombre_materia, au.nombre as nombre_autor from Libro as a, Autores as au, Materias as m, Ejemplares as e  where e.libro = a.id and m.id = a.materia and au.id = a.autor and a.enabled=1 and '.$Query.' ', null);
            } else {
                $autores = $db->rawQuery('SELECT *, a.nombre as nombre_libro from Libro as a where enabled=1 and nombre like "%' . $query . '%" ', null);
            }
        } else {
            $autores = $db->rawQuery('SELECT * from Libro as a where enabled=1', null);
        }


        return $autores;
    }

    public function getBook($book_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $book_id);
        $book = $db->get("Libro as a", null, null);

        return $book;
    }

    public function createBook($book) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $idBooks = $db->insert('Libro', $book);

        if ($idBooks) {
            return array("return" => true, "mensaje" => "Libro creado!", "nombre" => $book['nombre'], "id" => $idBooks);
        } else {
            //echo "mal 2";
            return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
        }
    }

}

?>