<?php

include 'headerBiblioteca.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Author");
$cl_autores = new Author();


$Autores = $cl_autores->getAutores();

//var_dump($Autores);
?>

<div class="content">
    <div class="container box">
        <section id="adm-information" class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend><h2>Lista de Autores</h2></legend>
                    <a href="/author/new" class="btn btn-danger">Agregar Nuevo Autor</a>
                </div>
            </div>
            <div class="col-sm-12" style="padding-top: 50px">
                <div class="row">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Status</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Autores as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value['id']?></td>
                                    <td><?php echo $value['nombre']?></td>
                                    <td><?php echo ($value['enabled'] == 1)?'Activo':'Inactivo'?></td>
                                    <td>
                                        <a href="/author/edit/<?php echo $value['id']?>" class="btn btn-xs btn-primary margin-right-5px">
                                            <span class="glyphicon glyphicon-pencil">
                                        </a>
                                        <a class="btn btn-xs btn-danger margin-right-5px" onclick='deleteAutor(<?php echo $value['id'] ?>)'>
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>



