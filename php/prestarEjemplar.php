<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Ejemplar");
$cl_ejemplar = new Ejemplar();

$ejemplar_id = Page::parseRequestVariable('ejemplar');
$usuario_id = Page::parseRequestVariable('usuario');

$data = Array ("usuario" => $usuario_id,
                "ejemplar" => $ejemplar_id);

die(json_encode($cl_ejemplar->prestarEjemplar($data)));