<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Directivos");
$cl_directivos = new Directivos();

if(trim($_POST['foto'])){
    $foto = Page::parseRequestVariable('foto');
}else{
    $foto = "null";
}

$nombre = Page::parseRequestVariable('nombre');
$apellido = Page::parseRequestVariable('apellido');
$email = Page::parseRequestVariable('email');
$cargo  = Page::parseRequestVariable('cargo');

$data = Array ("TipoUsuario" => 1,
                "foto" => $foto, 
                "nombre" => $nombre, 
                "apellido" => $apellido, 
                "email" => $email);

return $cl_directivos->createDirectivo($data, $cargo);
