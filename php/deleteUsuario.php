<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Usuario");
$cl_user = new Usuario();

$user_id = Page::parseRequestVariable('id');
die(json_encode($cl_user->disableUsuario($user_id)));