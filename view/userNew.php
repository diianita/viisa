<?php
include 'headerBiblioteca.php';

Page::loadClass("TipoUsuario");
$cl_TipoUsuarios = new TipoUsuario();

Page::loadClass("Usuario");
$cl_user = new Usuario();

$TipoUsuarios = $cl_TipoUsuarios->getTipoUsuarios();
$familiares = $cl_user->getFamiliares();

?>

<div class="content">
    <div class="container box">
        <section id="adm-information" class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend>
                        <h2>Agregar Usuario</h2>
                    </legend>
                </div>
            </div>
            <div class="col-sm-12" style="padding-top: 50px">
                <div class="row">
                    <div class="col-md-6">
                        <div class="well">
                            <form class="form-horizontal" role="form" id="form-crear-user">
                                <div class="form-group" style="margin-top: 20px">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <input class="form-control" type="text" placeholder="Nombre" name="nombre" id="nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <input class="form-control" type="text" placeholder="Apellido" name="apellido" id="apellido">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <input class="form-control" type="password" placeholder="Contraseña" name="contrasena" id="contrasena">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <select class="form-control pull-left userTipo" name="tipo">
                                            <option value="">Seleccionar un Tipo de Usuario</option>
                                            <?php
                                            foreach ($TipoUsuarios as $key => $value) {
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['desc'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <input class="form-control" type="email" placeholder="Email" name="email" id="email">
                                    </div>
                                </div>

                                <div class="other-data" style="display: none;">
                                    <h5 style="text-align: center;">Otros Datos</h5>

                                    <!-- Para usuario Directivo-->
                                    <div class="form-group cargo-data" style="display: none;">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control" type="text" placeholder="Cargo" name="cargo" id="cargo">
                                        </div>
                                    </div>

                                    <!-- Para usuario Docente-->
                                    <div class="form-group materia-data" style="display: none;">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control" type="text" placeholder="Materia" name="materia" id="materia">
                                        </div>
                                    </div>

                                    <!-- Para usuario Estiduante-->
                                    <div class="form-group estudiante-data" style="display: none;">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <select class="form-control pull-left" name="estFamiliar" id="estFamiliar">
                                                <option value="">Seleccionar un Familiar</option>
                                                <?php
                                                foreach ($familiares as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre']." ".$value['apellido'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group grado-data" style="display: none;">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control" type="text" placeholder="Grado" name="estGrado" id="estGrado">
                                        </div>
                                    </div>

                                    <!-- Para usuario Familiar-->
                                    <div class="form-group parentesco-data" style="display: none;">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control" type="text" placeholder="Parentesco" name="fmParentesco" id="fmParentesco">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <button type="submit" class="btn btn-primary pull-right btn-crear-user">Crear</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-offset-2 col-md-4">
                        <img src="../sources/images/books.png">
                    </div>
                </div>
            </div>
        </section>
        <div id="gotop" class="gotop fa fa-arrow-up"></div>
    </div>
</div>