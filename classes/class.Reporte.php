<?php

class Reporte {

    function __construct() {
        
    }

    public function getBooksByUser($user_id, $materia_id, $prestamo_estado) {
        $db = new Mysqlidb(Page::$dbhost, Page::$dbuser, Page::$dbpass, Page::$dbname) or die('No se pudo establecer la conexion con la base de datos');
        $whereMateria = $whereEstado = "";
        
        if($materia_id == "all"){
            $whereMateria = "l.materia = m.id";
        }else{
            $whereMateria = "l.materia = ".$materia_id;
        }

        if($prestamo_estado == "all"){
            $whereEstado = "";
        }else{
            $whereEstado = "p.enabled = ".$prestamo_estado." AND";
        }

        $books = $db->rawQuery('SELECT l.nombre as libro, m.nombre as materia, e.codigo as ejemplar, p.fechaPrestamo as fechaPrestamo, p.fechaEntrega as fechaEntrega, p.enabled as estado FROM Prestamo as p, Ejemplares as e, Libro as l, Materias as m where '.$whereEstado.' p.usuario = '.$user_id.' AND p.ejemplar = e.id AND e.libro = l.id AND '.$whereMateria. ' ORDER BY p.enabled ASC, p.fechaPrestamo ASC', null);

        return $books;
    }

}

?>