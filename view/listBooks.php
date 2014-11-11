<?php

include 'headerBiblioteca.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Books");
$cl_books = new Books();
$Books = $cl_books->getBooks();


Page::loadClass("Editorial");
$cl_editorial = new Editorial();

Page::loadClass("Author");
$cl_autor = new Author();

Page::loadClass("Materias");
$cl_materias = new Materias();

Page::loadClass("Ejemplar");
$cl_ejemplares = new Ejemplar();


Page::loadClass("Prestamo");
$cl_prestamos = new Prestamo();


//var_dump($Autores);
?>

<div class="content">
    <div class="container box">
        <section id="managers" class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <h2>Lista De libros</h2>
                    <a href="/newBook" class="btn btn-danger">Agregar Nuevo Libro</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Materia</th>
                            <th>Nombre</th>
                            <th>Autor</th>
                            <th>Descripcion</th>
                            <th>Editorial</th>
                            <th>Cant. Ejemplares</th>
                            <th>Cant. en Prestamo</th>
                            <th>Cant. Disponibles</th>
                            <th style="width: 200px">Acciones</th>
                        </thead>
                        <tbody>
                            <?php foreach ($Books as $key => $value) { 
                                //var_dump($value);
                                ?>

                                <tr>
                                    <td><?php echo $value['id_libro']?></td>
                                    <td><?php echo $value['nombre_materia'] ?></td>
                                    <td><?php echo $value['nombre'] ?></td>
                                    <td><?php echo $value['nombre_autor'] ?></td>
                                    <td><?php echo $value['descripcion_libro']?></td>
                                    <td><?php echo $value['editorial_nombre']?></td>
                                    <td><?php echo $cl_ejemplares->getTotalEjemplares($value['id_libro'])?></td>
                                    <td><?php echo $cl_prestamos->getTotalPrestamos($value['id_libro'])?></td>
                                    <td><?php echo $cl_ejemplares->getTotalEjemplares($value['id_libro']) - $cl_prestamos->getTotalPrestamos($value['id_libro'])?></td>
                                    <td>
                                        <a title="Lista de ejemplares" class="btn btn-xs btn-warning">Ejemplares</a>
                                        <!--<button title="Asignar " class="btn btn-success btn-xs" data-book="<?php echo $value['id']?>" data-title="New" data-toggle="modal" data-target="#new" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-plus"></span></button>-->
                                        <!--<button title="Editar Libro"class="btn btn-primary btn-xs" data-book="<?php echo $value['id']?>" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button>-->
                                        <!--<button class="btn btn-danger btn-xs"  data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button>-->
                                        <a href="/book/edit/<?php echo $value['id_libro'];?>" class="btn btn-xs btn-primary">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a title="Eliminar Libro" class="btn btn-xs btn-danger" data-book="<?php echo $value['id']?>" onclick='deleteLibro(<?php echo $value['id'] ?>)'>
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="clearfix"></div>
                    <ul class="pagination pull-right">
                        <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                        <li class="active"><a href="#">1</a></li>
                       <!-- <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>-->
                        <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>
