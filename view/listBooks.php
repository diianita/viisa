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
                                $ejemplares_total = $cl_ejemplares->getTotalEjemplares($value['libro_id']);
                                $ejemplares_prestamo = $cl_prestamos->getTotalPrestamos($value['libro_id']);
                                ?>

                                <tr>
                                    <td><?php echo $value['libro_id']?></td>
                                    <td><?php echo $value['libro_materia'] ?></td>
                                    <td><?php echo $value['libro_nombre'] ?></td>
                                    <td><?php echo $value['libro_autor'] ?></td>
                                    <td><?php echo $value['libro_dec']?></td>
                                    <td><?php echo $value['libro_editorial']?></td>
                                    <td><?php echo $ejemplares_total ?></td>
                                    <td><?php echo $ejemplares_prestamo ?></td>
                                    <td><?php echo $ejemplares_total - $ejemplares_prestamo?></td>
                                    <td>
                                        <a href="/book/detail/<?php echo $value['libro_id'];?>" title="Lista de ejemplares" class="btn btn-xs btn-warning">Ejemplares</a>
                                        <a href="/book/edit/<?php echo $value['libro_id'];?>" class="btn btn-xs btn-primary">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a title="Eliminar Libro" class="btn btn-xs btn-danger" data-book="<?php echo $value['libro_id']?>" onclick='deleteLibro(<?php echo $value['libro_id'] ?>)'>
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
