<?php
include '../classes/class.Page.php';

Page::loadConfig();
Page::loadDB();

Page::loadClass("Books");
$cl_book = new Books();

$book_id = Page::parseRequestVariable('id');
die(json_encode($cl_book->disableBook($book_id)));