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
$book = $cl_book->getBook($book_id);
$ejemplares = $cl_book->getBookEj($book_id);

$materia = $cl_materias->getMateria($book['materia']);
$autor = $cl_autores->getAuthor($book['autor']);
$editorial = $cl_editorial->getEditorial($book['editorial']);
?>
<div class="content">
    <div class="container box">
        <section class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend><h2>Detalle del Libro</h2></legend>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Materia:</label>
                            <span><?php echo $materia['nombre'] ?></span>
                        </div>
                        <div class="form-group">
                            <label>Autor:</label>
                            <span><?php echo $autor['nombre'] ?></span>
                        </div>
                        <div class="form-group">
                            <label>Editorial:</label>
                            <span><?php echo $editorial['nombre'] ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nombre:</label>
                            <span><?php echo $book['nombre'] ?></span>
                        </div>
                        <div class="form-group">
                            <label>Descripci&oacute;n:</label>
                            <span><?php echo $book['descripcion'] ?></span>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-xs btn-warning pull-right" data-book="<?php echo $value['libro_id'] ?>">
                                <span class="glyphicon glyphicon-plus"></span> Agregar Ejemplar
                            </a>
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-6">
                        <?php
                        foreach ($ejemplares as $key => $value) {
                            ?>
                            <div class="alert alert-warning">
                                <div class="">
                                    <a title="Eliminar Ejemplar" class="btn btn-xs btn-danger pull-right" onclick='deleteEjemplar(<?php echo $value['id'] ?>)'>
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </div>
                                <div class="">
                                    <label>Código:</label>
                                    <span><?php echo $value['codigo'] ?></span>
                                </div>
                                <div class="">
                                    <label>Descripci&oacute;n:</label>
                                    <span><?php echo $value['descripcion'] ?></span>
                                </div>
                                <div class="">
                                    <label>Estado:</label>
                                    <span></span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </section>
        <div id="gotop" class="gotop fa fa-arrow-up"></div>
    </div>
</div>



