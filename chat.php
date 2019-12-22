<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/sipalu/helper/url_helper.php';
require_once base_server() . 'config/Koneksi.php';

function getChat()
{
    global $koneksi;

    $chat = $koneksi->query("SELECT id_user,isi,waktu,role FROM chat INNER JOIN users ON chat.user_id=users.id_user ORDER BY waktu ASC")->fetchAll();

    for ($i = 0; $i < sizeof($chat); $i++) {
        $chat[$i]->user = $koneksi->query("SELECT nama,foto FROM {$chat[$i]->role}")->fetch();
    }
    return $chat;
}

echo json_encode(getChat());
// var_dump(getChat());
