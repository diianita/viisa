<?php

include 'headerBiblioteca.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Reporte");
$cl_reporte = new Reporte();

Page::loadClass("Usuario");
$cl_user = new Usuario();

$user_id = Page::parseRequestVariable('user');
$materia_id = Page::parseRequestVariable('materia');
$prestamo_estado = Page::parseRequestVariable('prestamo');

$user = $cl_user->getUsuario($user_id);
$books_prestamo = $books_devuelto = null;

switch ($prestamo_estado) {
    case "all":
        $books_prestamo = $cl_reporte->getBooksByUser($user_id, $materia_id, $prestamo_estado);
        $books_devuelto = $cl_reporte->getBooksByUser($user_id, $materia_id, $prestamo_estado);
        break;
    case "1": // en prestamo
        $books_prestamo = $cl_reporte->getBooksByUser($user_id, $materia_id, $prestamo_estado);
        break;
    case "0": // devuelto
        $books_devuelto = $cl_reporte->getBooksByUser($user_id, $materia_id, $prestamo_estado);
        break;
    default:
        break;
}

// FALTA IMPRIMIR LA TABLA VALIDANDO DE QUE SEA NULO

?>
<div class="content">
    <div class="container box ">
        <section id="adm-information" class="row padding-top-5px">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend>
                        <h2>Reporte de Prestamos</h2>
                        <h4><?php echo ucwords($user['nombre']." ".$user['apellido']); ?> <?php echo "(".$user['email'].")"; ?></h4>
                    </legend>
                </div>
            </div>
            <div class="col-sm-12">
                
            </div>
        </section>
        <div id="gotop" class="gotop fa fa-arrow-up"></div>
    </div>
</div>


