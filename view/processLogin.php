<?php
include '../classes/class.Page.php';
Page::loadConfig();
Page::loadDB();

Page::loadClass("Usuario");
$cl_usuario = new Usuario();

$action = isset($_REQUEST['function']) ? $_REQUEST['function'] : FALSE;
$usuario = isset($_REQUEST['username']) ? $_REQUEST['username'] : FALSE;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : FALSE;

if($cl_usuario->login($usuario, $password)){
    $result = array('success'=>true);
}else{
    $result = array('success'=>false);
}
die(json_encode($result));