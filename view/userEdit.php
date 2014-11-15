<?php
include 'headerBiblioteca.php';

Page::loadClass("Usuario");
$cl_user = new Usuario();

Page::loadClass("TipoUsuario");
$cl_TipoUsuarios = new TipoUsuario();

Page::loadClass("Directivos");
$cl_directivos = new Directivos();

Page::loadClass("Docente");
$cl_docente = new Docente();

Page::loadClass("Estudiante");
$cl_estudiante = new Estudiante();

Page::loadClass("Familiar");
$cl_familiar = new Familiar();

$user_id = $_REQUEST['value'];

$error_count = 0;
$error_msj = "";
$form = "";

$user_directivo = $user_docente = $user_estudiante_1 = $user_estudiante_2 = $user_familiar = "";
$general_css = $directivo_css = $docente_css = $estudiante_css = $familiar_css = "display: none;";

if (!isset($_REQUEST['btn-user-edit'])) {
    $user = $cl_user->getUsuario($user_id);
    $TipoUsuarios = $cl_TipoUsuarios->getTipoUsuarios();
    $familiares = $cl_user->getFamiliares();

    switch ($user['tipoUsuario']) {
        case "1"://directivo
            $data = $cl_directivos->getDirectivo($user_id);
            $user_directivo = $data['descripcion'];
            $general_css = $directivo_css = "";
            break;
        case "2"://docente
            $data = $cl_docente->getDocente($user_id);
            $user_docente = $data['descripcion'];
            $general_css = $docente_css = "";
            break;
        case "4"://estudiante
            $data = $cl_estudiante->getEstudiante($user_id);
            $user_estudiante_1 = $data['familiar'];
            $user_estudiante_2 = $data['grado'];
            $general_css = $estudiante_css = "";
            break;
        case "5"://familiar
            $data = $cl_familiar->getFamiliar($user_id);
            $user_familiar = $data['vinculo'];
            $general_css = $familiar_css = "";
            break;
    }
    
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
    } else {
        $userTipo = Page::parseRequestVariable('tipo');
        $array_result = "";

        switch ($userTipo) {
            case "1": //Personal
                $data2 = Array("descripcion" => Page::parseRequestVariable('cargo'));
                $array_result = $cl_directivos->updateDirectivo($user_id, $data2);
                break;
            case "2":
                $data2 = Array("descripcion" => Page::parseRequestVariable('materia'));
                $array_result = $cl_docente->updateDocente($user_id, $data2);
                break;
            case "4": //Estudiante
                $data2 = Array("familiar" => Page::parseRequestVariable('estFamiliar'), "grado" => Page::parseRequestVariable('estGrado'));
                $array_result = $cl_estudiante->updateEstudiante($user_id, $data2);
                break;
            case "5": //Familiar
                $data2 = Array("vinculo" => Page::parseRequestVariable('fmParentesco'));
                $array_result = $cl_familiar->updateFamiliar($user_id, $data2);
                break;
            default :
                $array_result = Array("return" => true);
                break;
        }

        if (!$array_result['return']) {
            $error_count ++;
            $error_msj = $update['mensaje'];
        }
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
                                <form class="form-horizontal" role="form" id="form-edit-user" action="<?php echo Page::getUrl() ?>user/edit/<?php echo $user_id ?>" method="POST">
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
                                    <div class="other-data" style="<?php echo $general_css ?>">
                                        <h5 style="text-align: center;">Otros Datos</h5>

                                        <!-- Para usuario Directivo-->
                                        <div class="form-group cargo-data" style="<?php echo $directivo_css ?>">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                <input class="form-control" type="text" placeholder="Cargo" name="cargo" value="<?php echo $user_directivo ?>">
                                            </div>
                                        </div>

                                        <!-- Para usuario Docente-->
                                        <div class="form-group materia-data" style="<?php echo $docente_css ?>">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                <input class="form-control" type="text" placeholder="Materia" name="materia" value="<?php echo $user_docente ?>">
                                            </div>
                                        </div>

                                        <!-- Para usuario Estiduante-->
                                        <div class="form-group estudiante-data" style="<?php echo $estudiante_css ?>">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                <select class="form-control pull-left" name="estFamiliar" id="estFamiliar">
                                                    <option value="">Seleccionar un Familiar</option>
                                                    <?php
                                                    foreach ($familiares as $key => $value) {
                                                        if ($user_estudiante_1 == $value['id']) {
                                                            ?>
                                                            <option selected="" value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] . " " . $value['apellido'] ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] . " " . $value['apellido'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group grado-data" style="<?php echo $estudiante_css ?>">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                <input class="form-control" type="text" placeholder="Grado" name="estGrado" value="<?php echo $user_estudiante_2 ?>">
                                            </div>
                                        </div>

                                        <!-- Para usuario Familiar-->
                                        <div class="form-group parentesco-data" style="<?php echo $familiar_css ?>">
                                            <div class="col-sm-offset-1 col-sm-10">
                                                <input class="form-control" type="text" placeholder="Parentesco" name="fmParentesco" value="<?php echo $user_familiar ?>">
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