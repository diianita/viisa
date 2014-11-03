<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if($function == 'biblioteca' || $function == 'usuarios' || $function == 'editorial' || $function == 'listBooks' || $function == 'autores'){
    ?>
<div class="content " style="margin-top: 20px;text-align: center">
    <div class="container box ">
        <a type="button" class="btn btn-info" href="/biblioteca">Inicio</a>
        <a type="button" class="btn btn-info" href="/usuarios">Usuarios</a>
        <a type="button" class="btn btn-info" href="/editorial">Editorial</a>
        <a type="button" class="btn btn-info" href="/listBooks">Inventario de Libros</a>
        <a type="button" class="btn btn-info" href="/autores">Autores</a>
        <a type="button" class="btn btn-danger" href="/logout">Cerrar Sesion</a>
    </div>

</div>



<?php
}
?>



