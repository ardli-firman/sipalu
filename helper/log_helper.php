<?php

require_once base_server() . "helper/database_helper.php";

function myLog($data)
{
    global $koneksi;
    $time = date('Y-m-d H:i:s');
    $stmt = $koneksi->prepare(dbInsert('log', ['user_id', 'aktivitas', 'time']));
    try {
        $stmt->execute([$data['id'], $data['aktivitas'], $time]);
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
}
