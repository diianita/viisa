<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Ejemplar");
$cl_ejemplar = new Ejemplar();

$ejemplar_id = Page::parseRequestVariable('id');
die(json_encode($cl_ejemplar->retornarEjemplar($ejemplar_id)));