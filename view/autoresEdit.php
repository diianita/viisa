<?php
include 'headerBiblioteca.php';

Page::loadClass("Author");
$cl_author = new Author();

$author_id = $_REQUEST['value'];

$error_count = 0;
$error_msj = "";
$form = "";

if (!isset($_REQUEST['btn-author-edotirial'])) {
    $author = $cl_author->getAuthor($author_id);
} else {
    $form = "enviado";
    $author_nombre = $_REQUEST['nombre'];
    $update = $cl_author->updateAuthor($author_id, $author_nombre);

    if (!$update['return']) {
        $error_count ++;
        $error_msj = $update['mensaje'];
    }
}

if ($error_count == 0 && trim($form)) {
    @header("location: " . Page::getUrl() . "listaAutores");
} else {
    ?>
    <div class="content">
        <div class="container box">
            <section id="adm-information" class="row">
                <div class="col-sm-12">
                    <div class="section-header text-center">
                        <legend><h2>Modificar Autor</h2></legend>
                    </div>
                </div>
                <div class="col-sm-12" style="padding-top: 50px">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well">
                                <form class="form-horizontal" role="form" id="form-crear-author" action="<?php echo Page::getUrl() ?>autores/edit/<?php echo $author_id ?>" method="POST">
                                    <div class="form-group" style="margin-top: 20px">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control nombre" type="text" name="nombre" value="<?php echo $author["nombre"] ?>">
                                            <?php
                                            if($error_count > 0){
                                                echo '<p class="has-error">'.$error_msj.'</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input type="hidden" name="btn-author-edotirial" value="editar"/>
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