<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Usuario");
$cl_user = new Usuario();

$user_type = Page::parseRequestVariable('typeUser');
$list_users = "";

$users = $cl_user->getUsuariosByTipo($user_type);
foreach ($users as $key => $value) {
    $list_users .= '<option value="'.$value['id'].'">'.$value['email'].'</option>';
}

die(json_encode($list_users));