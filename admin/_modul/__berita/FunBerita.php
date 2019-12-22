<?php

require_once base_server() . 'helper/database_helper.php';
require_once base_server() . 'helper/upload_helper.php';


function getAllArtikel()
{
    global $koneksi;

    $artikels = $koneksi->query(dbGet('artikel') . " INNER JOIN users ON users.id_user = artikel.user_id WHERE artikel.deleted='0' ORDER BY artikel.tanggal ASC")->fetchAll();

    return $artikels;
}

function getAllArtikelByJenis($jenis = null, $limit = null)
{
    global $koneksi;

    $artikels =  $koneksi->query(dbGet('artikel') . " WHERE artikel.jenis='$jenis' AND artikel.status_artikel='diterima' AND artikel.deleted='0' ORDER BY artikel.tanggal ASC $limit")->fetchAll();
    return $artikels;
}

function getArtikel($id = null)
{
    global $koneksi;

    $artikel = $koneksi->query(dbGetWhere('artikel', ['id_artikel' => $id]))->fetch();

    return $artikel;
}

function getArtikelByUserId($user_id)
{
    global $koneksi;

    $artikel = $koneksi->query(dbGetWhere('artikel', ['user_id' => $user_id]) . " AND deleted='0'")->fetchAll();

    return $artikel;
}

function insertPostingan($data = null)
{
    global $koneksi;

    $status_artikel = 'menunggu';
    $idUser = $_SESSION['user']->user_id;

    if ($_SESSION['user']->role == 'admin') {
        $status_artikel = "diterima";
    }

    $stmt = $koneksi->prepare(dbInsert('artikel', ['user_id', 'judul', 'isi', 'jenis', 'sampul', 'status_artikel', 'tanggal']));
    try {
        if (@$_FILES['sampul']['error'] !== 4) {
            $foto = upload(@$_FILES['sampul'], 'berita/sampul');
        } else {
            $foto = 'sampul.jpg';
        }
        if ($foto != false) {
            $stmt->execute([$idUser, @$data['judul'], @$data['isi'], @$data['jenis'], $foto, $status_artikel, date('Y-m-d')]);
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

function updateArtikel($data = [], $id_artikel = null)
{
    global $koneksi;

    $edit_rows = ['judul', 'isi', 'jenis'];
    $updateData = [@$data['judul'], @$data['isi'], @$data['jenis']];

    if (@$_FILES['sampul']['error'] !== 4) {
        $foto = upload(@$_FILES['sampul'], 'berita/sampul');
        if (is_string($foto)) {
            array_push($updateData, $foto);
            array_push($edit_rows, 'sampul');
        }
    }

    array_push($updateData, $id_artikel);

    $res = $koneksi->prepare(dbUpdate('artikel', $edit_rows, 'id_artikel'));
    try {
        $res->execute($updateData);
        return true;
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}

function deleteArtikel($id = null)
{
    global $koneksi;

    try {
        $res = $koneksi->prepare(dbUpdate('artikel', ['deleted'], 'id_artikel'));
        $res->execute([true, $id]);

        if ($res->rowCount() == 1) {
            return true;
            die;
        }
        return false;
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}
