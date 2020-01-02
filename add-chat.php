<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/sipalu/helper/url_helper.php';
require_once base_server() . 'config/Koneksi.php';
require_once base_server() . 'helper/database_helper.php';

function postChat($data = [])
{
    global $koneksi;
    date_default_timezone_set('Asia/jakarta');
    $timestamp = date('Y-m-d H:i:s');
    $idUser = $_SESSION['user']->user_id;
    $res = $koneksi->prepare(dbInsert('chat', ['user_id', 'isi', 'waktu']));

    $res->execute([$idUser, $data['isi'], $timestamp]);
}

if (isset($_POST)) {
    postChat($_POST);
}
