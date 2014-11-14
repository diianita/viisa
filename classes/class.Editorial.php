<?php

class Editorial {

    function __construct() {
        
    }

    public function getEditoriales() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $editoriales = $db->rawQuery('SELECT * from Editoriales as a where enabled=1', null);

        return $editoriales;
    }

    public function getEditorial($editorial_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $editorial_id);
        $editorial = $db->getOne("Editoriales as a", null, null);

        return $editorial;
    }

    public function createEditorial($editorial) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $idEditorial = $db->insert('Editoriales', $editorial);

        if ($idEditorial) {
            return array("return" => true, "mensaje" => "Directivo creado!");
        } else {
            //echo "mal 2";
            return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
        }
    }

    public function updateEditorial($id, $nombre) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where('id', $id);
        
        $data = Array('nombre' => $nombre);
        if ($db->update('Editoriales', $data)){
            return array("return" => true, "mensaje" => "Editorial modificada");
        }else{
            return array("return" => false, "mensaje" => "update failed: ".$db->getLastError());
        }
    }
    
    public function disableEditorial($id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');

        $prestamos = $db->rawQuery('SELECT count(*) from Libro as l, Ejemplares as e, Prestamo as p where l.editorial= '.$id.' and l.id = e.libro and e.id = p.ejemplar', null);
        if ($prestamos[0]['count(*)'] == 0) {
            $db->where('id', $id);        
            $data = Array('enabled' => 0);
            if ($db->update('Editoriales', $data)){
                return array("success" => true, "mensaje" => "Editorial modificada");
            }else{
                return array("success" => false, "mensaje" => "error en la base de datos");
            }
        } else {
            return array("success" => false, "mensaje" => "existen libros en prestamo");
        }
        
        
        
        
    }
}
?>