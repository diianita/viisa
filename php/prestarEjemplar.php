<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Ejemplar");
$cl_ejemplar = new Ejemplar();

$ejemplar_id = Page::parseRequestVariable('ejemplar');
$usuario_id = Page::parseRequestVariable('usuario');
$fechaPrestamo = date('Y-m-d');

$data = Array ("usuario" => $usuario_id,
                "ejemplar" => $ejemplar_id,
                "fechaPrestamo" => $fechaPrestamo);

die(json_encode($cl_ejemplar->prestarEjemplar($data)));