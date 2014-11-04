<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Author");
$cl_author = new Author();

$author_id = Page::parseRequestVariable('id');
$data = Array ("nombre" => $nombre);

die(json_encode($cl_author->disableAuthor($author_id)));
