<?php

class Ejemplar {

    function __construct() {
        
    }

    public function getEjemplares() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $autores = $db->rawQuery('SELECT * from Ejemplares as a where enabled=1', null);

        return $autores;
    }
    
    public function getTotalEjemplares($book_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $autores = $db->rawQuery('SELECT count(*) as total from Ejemplares as a where enabled=1 and libro='.$book_id.' ', null);

        return $autores[0]['total'];
    }

    public function getEjemplar($ejemplar_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $ejemplar_id);
        $ejemplar = $db->get("Ejemplares as a", null, null);

        return $ejemplar;
    }

    public function createEjemplar($ejemplar) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $idEjemplar = $db->insert('Ejemplares', $ejemplar);

        if ($idEjemplar) {
            return array("return" => true, "mensaje" => "Ejemplar creado!");
        } else {
            return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
        }
    }
    
    public function disableEjemplar($id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $prestamos = $db->rawQuery('SELECT count(*) from Prestamo as p where p.ejemplar = '.$id.'', null);

        if ($prestamos[0]['count(*)'] == 0) {
            $db->where('id', $id);        
            $data = Array('enabled' => 0);
            if ($db->update('Ejemplares', $data)){
                return array("success" => true, "mensaje" => "Ejemplar modificado");
            }else{
                return array("success" => false, "mensaje" => "error en la base de datos");
            }
        } else {
            return array("success" => false, "mensaje" => "Hubo un error, el ejemplar está en prestamo");
        }
    }
}

?>