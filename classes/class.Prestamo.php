<?php

class Prestamo {

    function __construct() {
        
    }

    public function getPrestamos() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $autores = $db->rawQuery('SELECT * from Prestamo as a where enabled=1', null);

        return $autores;
    }
    
    public function getTotalPrestamos($book_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $autores = $db->rawQuery('SELECT count(*) as total from Prestamo as a where enabled=1 and libro='.$book_id.' ', null);

        return $autores[0]['total'];
    }

    public function getPrestamo($prestamo_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $prestamo_id);
        $prestamo = $db->get("Prestamo as a", null, null);

        return $prestamo;
    }

    public function createPrestamo($prestamo) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $idPrestamo = $db->insert('Prestamo', $prestamo);

        if ($idPrestamo) {
            return array("return" => true, "mensaje" => "Prestamo creado!");
        } else {
            //echo "mal 2";
            return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
        }
    }

}

?>