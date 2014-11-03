<?php

class Materias {

    function __construct() {
        
    }

    public function getMaterias() {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $autores = $db->rawQuery('SELECT * from Materias as a where enabled=1', null);

        return $autores;
    }

    public function getMateria($materia_id) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $db->where("a.enabled", 1);
        $db->where("a.id", $materia_id);
        $materia = $db->get("Materias as a", null, null);

        return $materia;
    }

    public function createMateria($materia) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $idMaterias = $db->insert('Materias', $materia);

        if ($idMaterias) {
            return array("return" => true, "mensaje" => "Materia creada!", "nombre" => $materia['nombre'],"id" => $idMaterias);
        } else {
            //echo "mal 2";
            return array("return" => false, "mensaje" => "Hubo un error, intentelo nuevamente.");
        }
    }

}

?>