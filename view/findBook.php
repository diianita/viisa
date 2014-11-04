<?php

include 'headerBiblioteca.php';


Page::loadConfig();
Page::loadDB();

//var_dump($_REQUEST);
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : FALSE;


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

$search = isset($_REQUEST['search']) ? $_REQUEST['search'] : FALSE;


switch ($action) {
    case 'autor':
        $prefix = ' para el autor ';
        $Params = array('autor' => $search, 'method' => 'autor');
        break;

    case 'materia':
        $prefix = ' para la materia ';
        $Params = array('materia' => $search, 'method' => 'materia');
        break;

    case 'codigo':
        $prefix = ' para el codigo ';
        $Params = array('codigo' => $search, 'method' => 'codigo');
        break;

    case 'nombre':
        $prefix = ' para el nombre del libro ';
        $Params = array('nombre' => $search, 'method' => 'nombre');
        break;

    default:
        $prefix = ' para el nombre del libro ';
        $Params = false;
        break;
}


Page::loadClass("Books");
$cl_books = new Books();
$Books = $cl_books->getBooks($search, $Params);
?>
<div class="content">
    <div class="container box ">
        <section id="adm-information" class="row padding-top-5px">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend><h2>Busqueda de libros</h2></legend>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="well">
                    <form class="form-horizontal" role="form" onclick="return false">
                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-10">
                                <label class="pull-left margin-top-5px margin-right-5px" >Criterio de Busqueda: </label>
                                <input type="text" class="form-control pull-left" id="searchText" value="<?php echo $search ?>" style="width: 650px">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-10">
                                <div class="form-group" style="margin-left: 10px">
                                    <label class="pull-left margin-top-5px margin-right-5px" style="margin-right: 15px;">Tipo de Busqueda: </label>
                                    <select class="form-control pull-left seleccione-filtro" style="width: 150px">
                                        <option value="materia" <?php echo ($action == 'materia') ? 'selected=selected' : '' ?>>Materia</option>
                                        <option value="nombre" <?php echo ($action == 'nombre') ? 'selected=selected' : '' ?>>Nombre</option>
                                        <option value="autor" <?php echo ($action == 'autor') ? 'selected=selected' : '' ?>>Autor</option>
                                        <option value="codigo"<?php echo ($action == 'codigo') ? 'selected=selected' : '' ?>>Codigo</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary pull-right search-book">Buscar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="search">


                    <?php
                    /*
                     * To change this license header, choose License Headers in Project Properties.
                     * To change this template file, choose Tools | Templates
                     * and open the template in the editor.
                     */
//include '../classes/class.Page.php';


                    if ($search) {



//var_dump($Autores);
                        ?>
                        <h2>Resultados <?php echo $prefix ?>: <i><?php echo $search ?></i></h2>


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
                                   
                                    <th>Cant. Disponibles</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Books as $key => $value) { ?>

                                            <tr>
                                                <td><?php echo $value['id_libro'] ?></td>
                                                <td><?php echo $value['nombre_materia'] ?></td>
                                                <td><?php echo $value['nombre_libro'] ?></td>
                                                <td><?php echo $value['nombre_autor'] ?></td>
                                                <td><?php echo $value['descripcion_libro'] ?></td>
                                                <td><?php echo $cl_editorial->getEditorial($value['editorial'])[0]['nombre'] ?></td>
                                                <td><?php echo $cl_ejemplares->getTotalEjemplares($value['id_libro']) - $cl_prestamos->getTotalPrestamos($value['id_libro']) ?></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <div class="clearfix"></div>
                                <?php /* ?>
                                <ul class="pagination pull-right">
                                    <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                                </ul>
                                <?php */ ?>
                            </div>
                        </div>



                        <?php
                    } else {
                        echo 'no se encontraron resultados.';
                    }
                    ?>

                </div>
            </div>
        </section>
        <div id="gotop" class="gotop fa fa-arrow-up"></div>
    </div>
</div>


