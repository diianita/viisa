<?php
include 'headerBiblioteca.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Usuario");
$cl_usuarios = new Usuario();


$Usuarios = $cl_usuarios->getUsuarios();

//var_dump($Autores);
?>

<div class="content">
    <div class="container box">
        <section id="adm-information" class="row">
            <div class="col-sm-12">
                <div class="section-header text-center">
                    <legend><h2>Lista de Usuarios del Sistema</h2></legend>
                    <a href="/newUser" class="btn btn-danger">Agregar Nuevo Usuario</a>
                </div>
            </div>
            <div class="col-sm-12" style="padding-top: 50px">
                <div class="row">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Tipo de Usuario</th>
                                <th>Status</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Usuarios as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value['idu']?></td>
                                    <td><?php echo ucfirst($value['nombre'])?></td>
                                    <td><?php echo ucfirst($value['apellido'])?></td>
                                    <td><?php echo $value['email']?></td>
                                    <td><?php echo $value['desc']?></td>
                                    
                                    <td><?php echo ($value['enabled'] == 1)?'Activo':'Inactivo'?></td>
                                    <td>
                                        <a class="btn btn-xs btn-primary margin-right-5px">Editar</a>
                                        <a class="btn btn-xs btn-danger margin-right-5px">Eliminar</a>
                                    </td>
                                </tr>
                                <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>



