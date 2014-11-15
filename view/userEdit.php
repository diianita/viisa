<?php
include 'headerBiblioteca.php';

Page::loadClass("Usuario");
$cl_user = new Usuario();

Page::loadClass("TipoUsuario");
$cl_TipoUsuarios = new TipoUsuario();

$user_id = $_REQUEST['value'];

$error_count = 0;
$error_msj = "";
$form = "";

if (!isset($_REQUEST['btn-user-edit'])) {
    $user = $cl_user->getUsuario($user_id);
    $TipoUsuarios = $cl_TipoUsuarios->getTipoUsuarios();
} else {
    $form = "enviado";

    $data = Array(
        "nombre" => Page::parseRequestVariable('nombre'),
        "apellido" => Page::parseRequestVariable('apellido'),
        "contrasena" => Page::parseRequestVariable('cotrasena'),
        "email" => Page::parseRequestVariable('email'),
        "tipoUsuario" => Page::parseRequestVariable('tipo'));

    $update = $cl_user->updateUsuario($user_id, $data);

    if (!$update['return']) {
        $error_count ++;
        $error_msj = $update['mensaje'];
    }
}

if ($error_count == 0 && trim($form)) {
    @header("location: " . Page::getUrl() . "user/list");
} else {
    ?>
    <div class="content">
        <div class="container box">
            <section id="adm-information" class="row">
                <div class="col-sm-12">
                    <div class="section-header text-center">
                        <legend><h2>Modificar Ususario</h2></legend>
                    </div>
                </div>
                <div class="col-sm-12" style="padding-top: 50px">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well">
                                <form class="form-horizontal" role="form" id="form-crear-user" action="<?php echo Page::getUrl() ?>user/edit/<?php echo $user_id ?>" method="POST">
                                    <div class="form-group" style="margin-top: 20px">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control nombre" type="text" value="<?php echo $user['nombre'] ?>" name="nombre">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control apellido" type="text" value="<?php echo $user['apellido'] ?>" name="apellido">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control contrasena" type="password" value="<?php echo $user['contrasena'] ?>" name="cotrasena">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <select class="form-control pull-left userTipo" name="tipo">
                                                <option value="0">Seleccionar un Tipo de Usuario</option>
                                                <?php
                                                foreach ($TipoUsuarios as $key => $value) {
                                                    if ($user['tipoUsuario'] == $value['id']) {
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>" selected=""><?php echo $value['desc'] ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['desc'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control email" type="email" value="<?php echo $user['email'] ?>" name="email">
                                        </div>
                                    </div>
                                    <div class="other-data" style="display: none;">
                                        <h5 style="text-align: center;">Otros Datos</h5>

                                        <!-- Para usuario Directivo-->
                                        <div class="form-group cargo-data" style="display: none;">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                <input class="form-control" type="text" placeholder="Cargo" name="cargo">
                                            </div>
                                        </div>

                                        <!-- Para usuario Docente-->
                                        <div class="form-group materia-data" style="display: none;">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                <input class="form-control" type="text" placeholder="Materia" name="materia">
                                            </div>
                                        </div>

                                        <!-- Para usuario Estiduante-->
                                        <div class="form-group estudiante-data" style="display: none;">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                <select class="form-control pull-left" name="estFamiliar">
                                                    <option value="">Seleccionar un Familiar</option>
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
                                        <div class="form-group grado-data" style="display: none;">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                <input class="form-control" type="text" placeholder="Grado" name="estGrado">
                                            </div>
                                        </div>

                                        <!-- Para usuario Familiar-->
                                        <div class="form-group parentesco-data" style="display: none;">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                <input class="form-control" type="text" placeholder="Parentesco" name="fmParentesco">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control foto" type="hidden" placeholder="Foto" name="foto">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input type="hidden" name="btn-user-edit" value="editar"/>
                                            <button type="submit" class="btn btn-primary pull-right">Modificar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-offset-2 col-md-4">
                            <img src="<?php echo Page::getUrl() ?>sources/images/books.png">
                        </div>
                    </div>
                </div>
            </section>
            <div id="gotop" class="gotop fa fa-arrow-up"></div>
        </div>
    </div>
    <?php
}
?>