<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Editorial");
$cl_editorial = new Editorial();

$editorial_id = Page::parseRequestVariable('id');
$data = Array ("nombre" => $nombre);

die(json_encode($cl_editorial->disableEditorial($editorial_id)));
