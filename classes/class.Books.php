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
                $autores = $db->rawQuery('SELECT *, a.id as id_libro, ed.nombre as editorial_nombre, a.descripcion as descripcion_libro,  a.nombre as nombre_libro, m.nombre as nombre_materia, au.nombre as nombre_autor from Libro as a, Autores as au, Materias as m, Ejemplares as e, Editoriales as ed  where ed.id = a.editorial and  e.libro = a.id and m.id = a.materia and au.id = a.autor and a.enabled=1 and '.$Query.' order by id_libro', null);
            } else {
                $autores = $db->rawQuery('SELECT *, a.id as id_libro, ed.nombre as editorial_nombre, a.descripcion as descripcion_libro, a.nombre as nombre_libro, m.nombre as nombre_materia, au.nombre as nombre_autor from Libro as a, Autores as au, Materias as m, Ejemplares as e,  Editoriales as ed where ed.id = a.editorial  and e.libro = a.id and m.id = a.materia and au.id = a.autor and a.enabled=1 and nombre like "%' . $query . '%" order by id_libro', null);
            }
        } else {
            $autores = $db->rawQuery('SELECT l.id as libro_id, l.nombre as libro_nombre, l.descripcion as libro_dec, ed.nombre as libro_editorial, m.nombre as libro_materia, au.nombre as libro_autor from Libro as l, Autores as au, Materias as m, Editoriales as ed where ed.id = l.editorial  and m.id = l.materia and au.id = l.autor and l.enabled=1 order by libro_id', null);
        }


        return $autores;
    }

    public function getBook($book_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $book_id);
        $book = $db->getOne("Libro as a", null, null);

        return $book;
    }
    
    public function getBookEj($book_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("e.enabled", 1);
        $db->where("e.libro", $book_id);
        $book = $db->get("Ejemplares as e", null, null);

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
    
    public function updateBook($id, $data) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where('id', $id);
        if ($db->update('Libro', $data)){
            return array("return" => true, "mensaje" => "Libro modificado");
        }else{
            return array("return" => false, "mensaje" => "update failed: ".$db->getLastError());
        }
    }
    
    public function disableBook($id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        
        $prestamos = $db->rawQuery('SELECT count(*) from Libro as l, Prestamo as p where l.id=' . $id . ' and l.id = p.libro', null);
        if ($prestamos[0]['count(*)'] == 0) {
            $db->where('id', $id);        
            $data = Array('enabled' => 0);
            if ($db->update('Libro', $data)){
                return array("success" => true, "mensaje" => "libro modificado");
            }else{
                return array("success" => false, "mensaje" => "error en la base de datos");
            }
        } else {
            return array("success" => false, "mensaje" => "existen libros en prestamo");
        }
    }

}

?>