<?php

require_once $_SERVER['DOCUMENT_ROOT'] . 'config/Koneksi.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'admin/_modul/__berita/FunBerita.php';

$res = getArtikel($_POST['id']);


echo json_encode($res);
