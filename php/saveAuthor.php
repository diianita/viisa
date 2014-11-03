<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Author");
$cl_autores = new Author();


$nombre = Page::parseRequestVariable('nombre');

$data = Array ("nombre" => $nombre);

die(json_encode($cl_autores->createAuthor($data)));
