<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Editorial");
$cl_editoriales = new Editorial();


$nombre = Page::parseRequestVariable('nombre');

$data = Array ("nombre" => $nombre);

die(json_encode($cl_editoriales->createEditorial($data)));
