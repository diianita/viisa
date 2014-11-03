<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Books");
$cl_books = new Books();


$nombre = Page::parseRequestVariable('nombre');
$materia= Page::parseRequestVariable('materias');
$autor = Page::parseRequestVariable('autor');
$editorial = Page::parseRequestVariable('editorial');
$descripcion = Page::parseRequestVariable('descripcion');

$data = Array ("nombre" => $nombre, "materia"=>$materia, "autor"=>$autor, "editorial"=>$editorial,"descripcion"=>$descripcion);

die(json_encode($cl_books->createBook($data)));
