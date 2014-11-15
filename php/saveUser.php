<?php

include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Usuario");
$cl_usuario = new Usuario();

Page::loadClass("Directivos");
$cl_directivos = new Directivos();

Page::loadClass("Estudiante");
$cl_estudiante = new Estudiante();

Page::loadClass("Familiar");
$cl_familiar = new Familiar();

$nombre = Page::parseRequestVariable('nombre');
$cotrasena = Page::parseRequestVariable('contrasena');
$apellido = Page::parseRequestVariable('apellido');
$email = Page::parseRequestVariable('email');
$userTipo = Page::parseRequestVariable('userTipo');

$data = Array("nombre" => $nombre, "contrasena" => $cotrasena, "apellido" => $apellido, "email" => $email, "tipoUsuario" => $userTipo);
$user_create = $cl_usuario->createUsuario($data);
$array_result = $user_create;

if ($user_create['return']) {
    switch ($userTipo) {
        case "1": //Personal
        case "2":
            $data2 = Array("usuario" => $user_create['id'], "descripcion" => Page::parseRequestVariable('otherData'));
            $array_result = $cl_directivos->createPeronal($data2);
            break;
        case "4": //Estudiante
            $data2 = Array("usuario" => $user_create['id'], "familiar" => Page::parseRequestVariable('otherData'), "grado" => Page::parseRequestVariable('otherData2'));
            $array_result = $cl_estudiante->createEstudiante($data2);
            break;
        case "5": //Familiar
            $data2 = Array("usuario" => $user_create['id'], "vinculo" => Page::parseRequestVariable('otherData'));
            $array_result = $cl_familiar->createFamiliar($data2);
            break;
    }
}

die(json_encode($array_result));
