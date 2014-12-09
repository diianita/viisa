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
$books_prestamo = $cl_reporte->getBooksByUser($user_id, $materia_id, $prestamo_estado);

?>
<div class="content">
    <div class="container box ">
        <section class="row padding-top-5px">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend>
                        <h2>Reporte de Prestamos</h2>
                        <h4><?php echo ucwords($user['nombre']." ".$user['apellido']); ?> <?php echo "(".$user['email'].")"; ?></h4>
                    </legend>
                </div>
            </div>
            
            <div class="col-sm-12">
                <legend>
                    <h2>Historial bibliotecario</h2>
                </legend>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <?php
                    if(is_null($books_prestamo) || count($books_prestamo) <= 0){
                    ?>
                        <h5>El usuario no tiene historial bibliotecario</h5>
                    <?php
                    }else{
                    ?>
                        <table id="mytable" class="table table-bordred table-striped table-hover">
                            <thead>
                                <th>Libro</th>
                                <th>Materia</th>
                                <th>Ejemplar</th>
                                <th>Fecha Prestamo</th>
                                <th>Fecha Entrega</th>
                                <th>Estado</th>
                            </thead>
                            <tbody>
                                <?php foreach ($books_prestamo as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['libro']?></td>
                                        <td><?php echo $value['materia'] ?></td>
                                        <td><?php echo $value['ejemplar'] ?></td>
                                        <td><?php echo $value['fechaPrestamo'] ?></td>
                                        <td><?php echo $value['fechaEntrega'] ?></td>
                                        <td><?php 
                                            $estado = ($value['estado'] == "1")? "En prestamo": "Devuelto";
                                            echo $estado;
                                        ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php
                    }
                    ?>

                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
        <div id="gotop" class="gotop fa fa-arrow-up"></div>
    </div>
</div>


