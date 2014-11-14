<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Ejemplar");
$cl_ejemplar = new Ejemplar();

$data = Array ("libro" => Page::parseRequestVariable('book'),
                "codigo" => Page::parseRequestVariable('codigo'),
                "descripcion" => Page::parseRequestVariable('descripcion'));

die(json_encode($cl_ejemplar->createEjemplar($data)));







