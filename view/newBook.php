<?php
include 'headerBiblioteca.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Materias");
$cl_materias = new Materias();
$Materias = $cl_materias->getMaterias();

Page::loadClass("Editorial");
$cl_editorial = new Editorial();
$Editorial = $cl_editorial->getEditoriales();

Page::loadClass("Author");
$cl_autores = new Author();
$Autores = $cl_autores->getAutores();


?>

<div class="content">
    <div class="container box">
        <section id="adm-information" class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend><h2>Agregar libros</h2></legend>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="well">
                            <form class="form-horizontal agregar-libro" role="form" onsubmit="return false">
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <select class="form-control pull-left margin-right-5px materias" style="width: 250px">
                                            <option value="0">Seleccionar una materia</option>
                                            <?php
                                            foreach ($Materias as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <a href="javascript:void(0);" type="button" class="btn btn-primary btn-xs nueva-materia pull-left margin-right-5px margin-top-5px" data-toggle="modal" data-target="#myModal">Agregar Nueva</a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <input class="form-control nombre" type="text" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                       
                                        <select class="form-control pull-left margin-right-5px autor">
                                            <option value="0">Seleccione un Autor</option>
                                            <?php
                                            foreach ($Autores as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                         <select class="form-control pull-left margin-right-5px editorial">
                                            <option value="0">Seleccione un Editorial</option>
                                            <?php
                                            foreach ($Editorial as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <textarea rows="2" class="form-control descripcion" placeholder="Descripción"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <button type="submit" class="btn btn-primary pull-right crear-libro">Crear</button>
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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar nueva materia</h4>
            </div>
            <div class="modal-body">
                Nombre: <input class="form-control materia-nueva" type="text" placeholder="Nombre Materia" name="materia-nueva">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary guardar-materia-nueva">Guardar</button>
            </div>
        </div>
    </div>
</div>