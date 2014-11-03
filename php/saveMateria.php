<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Materias");
$cl_materias = new Materias();


$nombre = Page::parseRequestVariable('nombre');

$data = Array ("nombre" => $nombre);

die(json_encode($cl_materias->createMateria($data)));
