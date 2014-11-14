<?php
include 'headerBiblioteca.php';

Page::loadClass("Materias");
Page::loadClass("Editorial");
Page::loadClass("Author");
Page::loadClass("Books");

$cl_materias = new Materias();
$cl_editorial = new Editorial();
$cl_autores = new Author();
$cl_book = new Books();

$book_id = $_REQUEST['value'];

$error_count = 0;
$error_msj = "";
$form = "";

if (!isset($_REQUEST['btn-book-edit'])) {
    $Materias = $cl_materias->getMaterias();
    $Editorial = $cl_editorial->getEditoriales();
    $Autores = $cl_autores->getAutores();
    $book = $cl_book->getBook($book_id);
    
} else {
    $form = "enviado";    
    $data = array(
        "materia" => $_REQUEST['materia'],
        "autor" => $_REQUEST['autor'],
        "editorial" => $_REQUEST['editorial'],
        "nombre" => $_REQUEST['nombre'],
        "descripcion" => $_REQUEST['descripcion']);
    
    $update = $cl_book->updateBook($book_id, $data);

    if (!$update['return']) {
        $error_count ++;
        $error_msj = $update['mensaje'];
    }
}

if ($error_count == 0 && trim($form)) {
    @header("location: " . Page::getUrl() . "book/list");
} else {
    ?>
    <div class="content">
        <div class="container box">
            <section class="row">
                <div class="col-sm-12">
                    <div class="section-header text-center">
                        <legend><h2>Modificar Libro</h2></legend>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well">
                                <form class="form-horizontal" role="form" id="form-edit-book" action="<?php echo Page::getUrl() ?>book/edit/<?php echo $book_id ?>" method="POST">
                                    <div class="form-group" style="margin-top: 20px">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <?php
                                            if($error_count > 0){
                                                echo '<p class="has-error">'.$error_msj.'</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <select class="form-control pull-left" name="materia" id="materia">
                                                <option value="">Seleccionar una materia</option>
                                                <?php
                                                foreach ($Materias as $key => $value) {
                                                    if($value['id'] == $book['materia']){
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>" selected=""><?php echo $value['nombre'] ?></option>
                                                        <?php
                                                    }else{
                                                       ?>
                                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input class="form-control nombre" type="text" placeholder="Nombre" value="<?php echo $book['nombre']?>" name="nombre" id="nombre">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <select class="form-control pull-left" name="autor" id="autor">
                                                <option value="">Seleccione un Autor</option>
                                                <?php
                                                foreach ($Autores as $key => $value) {
                                                    if($value['id'] == $book['autor']){
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>" selected=""><?php echo $value['nombre'] ?></option>
                                                        <?php
                                                    }else{
                                                       ?>
                                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <select class="form-control pull-left" name="editorial" id="editorial">
                                                <option value="">Seleccione una Editorial</option>
                                                <?php
                                                foreach ($Editorial as $key => $value) {
                                                    if($value['id'] == $book['editorial']){
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>" selected=""><?php echo $value['nombre'] ?></option>
                                                        <?php
                                                    }else{
                                                       ?>
                                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <textarea rows="2" class="form-control" placeholder="Descripción" name="descripcion" id="descripcion">
                                                <?php echo $book['descripcion']?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <input type="submit" class="btn btn-primary pull-right" name="btn-book-edit" id="btn-book-edit" value="Modificar"/>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-offset-2 col-md-4">
                            <img src="<?php echo Page::getUrl()?>sources/images/books.png">
                        </div>
                    </div>
                </div>
            </section>
            <div id="gotop" class="gotop fa fa-arrow-up"></div>
        </div>
    </div>
    <?php
}

    
    
