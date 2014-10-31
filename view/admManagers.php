<?php
Page::loadClass("Directivos");
$cl_directivos = new Directivos();

$directivos = $cl_directivos->getDirectivos();
?>

<div class="content">
    <div class="container box">
        <section id="adm-information" class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend><h2>Administraci&oacute;n de Directivos</h2></legend>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-create-manager">Crear Directivo</button>
                </div>
            </div>
            <div class="col-sm-12">
                <?php
                foreach ($directivos as $key => $value) {
                    $img = Page::$site_url;
                    $img .= ($value['foto'] == null || $value['foto'] == "") ? "sources/images/user.png":$value['foto'];
                    ?>
                    <div class="container-<?php echo $key; ?>">
                        <div class="col-md-2 well" style="margin: 4px;">
                            <center>
                                <form id="imageform-<?php echo $key; ?>" method="post" enctype="multipart/form-data" action="">
                                    <div class="form-group">
                                        <div id="preview-image-<?php echo $key; ?>">
                                            <img src="<?php echo $img; ?>" name="img-<?php echo $key; ?>" class="img-rounded" width="140" height="140" style="width: 140px;height: 140px;">
                                        </div>
                                        <a class="btn btn-primary" style="position: absolute;margin-left: -40px;margin-top: -42px;">Modificar
                                            <input type="file" class="file-upload" name="photoimg-<?php echo $key; ?>" id="photoimg-<?php echo $key; ?>" style="opacity: 0;width: 85px;position: absolute;margin-left: -45px;margin-top: -29px;">
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" name="nombre-<?php echo $key; ?>" id="nombre-<?php echo $key; ?>" value="<?php echo $value['nombre']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <input type="text" class="form-control" name="nombre-<?php echo $key; ?>" id="apellido-<?php echo $key; ?>" value="<?php echo $value['apellido']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email-<?php echo $key; ?>" id="email-<?php echo $key; ?>" value="<?php echo $value['email']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <input type="text" class="form-control" name="nombre-<?php echo $key; ?>" id="cargo-<?php echo $key; ?>" value="<?php echo $value['descripcion']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" data-key="<?php echo $key; ?>">Actualizar</button>
                                    </div>
                                </form>
                            </center>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
        <div id="gotop" class="gotop fa fa-arrow-up"></div>
    </div>
</div>

<div class="modal fade" id="modal-create-manager" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="form-create-manager" action="" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Crear Directivo</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Foto</label>
                            <div class="col-md-9">
                                <input type="file" id="myFile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nombreManager" id="nombreManager">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Apellido</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="apellidoManager" id="apellidoManager">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="emailManager" id="emailManager">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Cargo</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="cargoManager" id="cargoManager">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btn-crear-manager">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>