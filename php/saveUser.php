<?php

include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Usuario");
$cl_usuario = new Usuario();


$nombre = Page::parseRequestVariable('nombre');
$cotrasena = Page::parseRequestVariable('contrasena');
$apellido = Page::parseRequestVariable('apellido');
$email = Page::parseRequestVariable('email');
$userTipo = Page::parseRequestVariable('userTipo');

$data = Array("nombre" => $nombre,
    "contrasena" => $cotrasena,
    "apellido" => $apellido,
    "email" => $email,
    "tipoUsuario"=>$userTipo);

die(json_encode($cl_usuario->createUsuario($data)));
