<?php

include 'headerBiblioteca.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Editorial");
$cl_editoriales = new Editorial();

$Editoriales = $cl_editoriales->getEditoriales();
?>

<div class="content">
    <div class="container box">
        <section id="adm-information" class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend><h2>Lista de Editoriales</h2></legend>
                    <a href="/newEditorial" class="btn btn-danger">Agregar Nuevo Editorial</a>
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
                            <?php foreach ($Editoriales as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value['id'] ?></td>
                                    <td><?php echo $value['nombre'] ?></td>
                                    <td><?php echo ($value['enabled'] == 1) ? 'Activo' : 'Inactivo' ?></td>
                                    <td>
                                        <a href="/editorial/edit/<?php echo $value['id']?>" class="btn btn-xs btn-primary margin-right-5px">Editar</a>
                                        <a class="btn btn-xs btn-danger margin-right-5px">Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>



