<?php

require_once $_SERVER['DOCUMENT_ROOT'] . 'helper/database_helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'helper/upload_helper.php';


function getAllArtikel()
{
    global $koneksi;

    $artikels = $koneksi->query(dbGet('artikel') . ' INNER JOIN users ON users.id_user = artikel.user_id')->fetchAll();

    return $artikels;
}

function getArtikel($id = null)
{
    global $koneksi;

    $artikel = $koneksi->query(dbGetWhere('artikel', ['id_artikel' => $id]))->fetch();

    return $artikel;
}

function insertPostingan($data = null)
{
    global $koneksi;

    $idUser = 30;
    $stmt = $koneksi->prepare(dbInsert('artikel', ['user_id', 'judul', 'isi', 'jenis', 'sampul', 'status_artikel', 'tanggal']));
    try {
        if (@$_FILES['sampul']['error'] !== 4) {
            $foto = upload(@$_FILES['sampul'], 'berita/sampul');
        } else {
            $foto = 'sampul.jpg';
        }
        if ($foto != false) {
            $stmt->execute([$idUser, @$data['judul'], @$data['isi'], @$data['jenis'], $foto, 'menunggu', date('Y-m-d')]);
            if ($stmt->rowCount() == 1) {
                return true;
                die;
            }
        }
        return false;
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}

function updateStatusArtikel($data = [])
{
    global $koneksi;

    $res = $koneksi->prepare(dbUpdate('artikel', ['status_artikel'], 'id_artikel'));
    try {
        $res->execute([@$data['post'], @$data['id']]);
        return true;
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}

function deleteArtikel($id = null)
{
    global $koneksi;

    try {
        $res = $koneksi->prepare(dbDelete('artikel', 'id_artikel'));
        $res->execute([$id]);

        if ($res->rowCount() == 1) {
            return true;
            die;
        }
        return false;
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}
