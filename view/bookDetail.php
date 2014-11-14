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
                        <div>
                            <label>Materia:</label>
                            <span><?php echo $materia['nombre'] ?></span>
                        </div>
                        <div>
                            <label>Autor:</label>
                            <span><?php echo $autor['nombre'] ?></span>
                        </div>
                        <div>
                            <label>Editorial:</label>
                            <span><?php echo $editorial['nombre'] ?></span>
                        </div>
                        <div>
                            <label>Nombre:</label>
                            <span><?php echo $book['nombre'] ?></span>
                        </div>
                        <div>
                            <label>Descripci&oacute;n:</label>
                            <span><?php echo $book['descripcion'] ?></span>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-xs btn-warning pull-right btn-modal-new-ej" data-book="<?php echo $book['id'] ?>">
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
                                    <a title="Eliminar Ejemplar" class="btn btn-xs btn-danger pull-right"onclick='deleteEjemplar(<?php echo $value['id'] ?>)'>
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                    <a title="Prestar Ejemplar" class="btn btn-xs btn-primary pull-right" style="margin-right: 4px;">
                                        <span class="glyphicon glyphicon-export"></span>
                                    </a>
                                    <a title="Retornar Ejemplar" class="btn btn-xs btn-success pull-right" style="margin-right: 4px;">
                                        <span class="glyphicon glyphicon-import"></span>
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

<!-- Modal -->
<div class="modal fade" id="modalEjemplar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="form-new-ej">
                <fieldset>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar nuevo ejemplar</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">C&oacute;digo</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="codigo" id="codigo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Descripci&oacute;n</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary guardar-ejemplar" data-book="">Guardar</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>



