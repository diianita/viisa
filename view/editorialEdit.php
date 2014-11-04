<?php
include 'headerBiblioteca.php';

Page::loadClass("Editorial");
$cl_editorial = new Editorial();

$editorial_id = $_REQUEST['value'];

$error_count = 0;
$error_msj = "";
$form = "";

if (!isset($_REQUEST['btn-edit-edotirial'])) {
    $editorial = $cl_editorial->getEditorial($editorial_id);
} else {
    $form = "enviado";
    $editrial_nombre = $_REQUEST['nombre'];
    $update = $cl_editorial->updateEditorial($editorial_id, $editrial_nombre);
    
    var_dump($update);

    if (!$update['return']) {
        $error_count ++;
        $error_msj = $update['mensaje'];
    }
}

if ($error_count == 0 && trim($form)) {
    @header("location: ".Page::getUrl()."listEditorial");
} else {
    ?>
    <div class="content">
        <div class="container box">
            <section id="adm-information" class="row">
                <div class="col-sm-12">
                    <div class="section-header text-center">
                        <legend><h2>Modificar Editorial</h2></legend>
                    </div>
                </div>
                <div class="col-sm-12" style="padding-top: 50px">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well">
                                <form class="form-horizontal form-crear-editorial" role="form" id="form-crear-editorial" action="<?php echo Page::getUrl() ?>editorial/edit/<?php echo $editorial_id ?>" method="POST">
                                    <div class="form-group" style="margin-top: 20px">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control nombre" type="text"  name="nombre" value="<?php echo $editorial["nombre"] ?>">
                                            <?php
                                            if($error_count > 0){
                                                echo '<p class="has-error">'.$error_msj.'</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input type="hidden" name="btn-edit-edotirial" value="editar"/>
                                            <button type="submit" class="btn btn-primary pull-right">modificar</button>
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

    
    
