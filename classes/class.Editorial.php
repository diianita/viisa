<?php

class Editorial {

    function __construct() {
        
    }

    public function getEditoriales() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $autores = $db->rawQuery('SELECT * from Editoriales as a where enabled=1', null);

        return $autores;
    }

    public function getEditorial($editorial_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $editorial_id);
        $editorial = $db->get("Editoriales as a", null, null);

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

}

?>