<?php

include 'headerBiblioteca.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("TipoUsuario");
$cl_TipoUsuarios = new TipoUsuario();

Page::loadClass("Materias");
$cl_materias = new Materias();

$TipoUsuarios = $cl_TipoUsuarios->getTipoUsuarios();
$Materias = $cl_materias->getMaterias();

?>
<div class="content">
    <div class="container box ">
        <section id="adm-information" class="row padding-top-5px">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend><h2>Filtro de Reportes</h2></legend>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="well">
                    <form class="form-horizontal" id="fm-filter-report" role="form" action="<?php Page::getUrl() ?>/reports/generate" method="POST">
                        <div class="row">
                            <div class="col-sm-offset-1 col-sm-10">
                                <div class="form-group">
                                    <label class="pull-left margin-top-5px margin-right-5px" >Tipo de usuario</label>
                                    <select class="form-control select-type" name="typeUser" id="typeUser">
                                        <option value="">Seleccionar un Tipo de Usuario</option>
                                        <?php
                                        foreach ($TipoUsuarios as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value['id'] ?>"><?php echo ucwords($value['desc']) ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="pull-left margin-top-5px margin-right-5px" >Usuario</label>
                                    <select class="form-control select-users" name="user" id="user">
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="pull-left margin-top-5px margin-right-5px" >Materia</label>
                                    <select class="form-control" name="materia" id="materia">
                                        <option value="all">Todas las materias</option>
                                        <?php
                                        foreach ($Materias as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo ucwords($value['nombre']) ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="pull-left margin-top-5px margin-right-5px" >Estado del prestamo</label>
                                    <select class="form-control" name="prestamo" id="prestamo">
                                        <option value="all">Todos los estados</option>
                                        <option value="1">En prestamo</option>
                                        <option value="0">Entregados</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">Generar reporte</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <div id="gotop" class="gotop fa fa-arrow-up"></div>
    </div>
</div>


