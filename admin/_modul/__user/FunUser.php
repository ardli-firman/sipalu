<?php

require_once base_server() . 'helper/database_helper.php';

function getAll()
{
    global $koneksi;

    $alumni = $koneksi->query(dbGet('users') . " INNER JOIN alumni ON users.id_user = alumni.user_id WHERE users.deleted='0'")->fetchAll();
    $admin = $koneksi->query(dbGet('users') . " INNER JOIN admin ON users.id_user = admin.user_id WHERE users.deleted='0'")->fetchAll();

    $res = array_merge($alumni, $admin);
    return $res;
}

function getAlumni()
{
    global $koneksi;

    $alumni = $koneksi->query(dbGet('users') . ' INNER JOIN alumni ON users.id_user = alumni.user_id')->fetchAll();
    return $alumni;
}

function updateStatusAkun($data = null)
{
    global $koneksi;

    $res = $koneksi->prepare(dbUpdate('users', ['status_user'], 'id_user'));
    if (isset($data['yes'])) {
        $status = $data['yes'];
    } else {
        $status = $data['no'];
    }
    $res->execute([$status, $data['id']]);
    return true;
}

function deleteAkun($id = null)
{
    global $koneksi;

    try {
        $res = $koneksi->prepare(dbUpdate('users', ['deleted'], 'id_user'));
        $res->execute([true, $id]);

        if ($res->rowCount() == 1) {
            return true;
            die;
        }
        return true;
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}

function insertAdmin($data = [], $foto = null)
{
    global $koneksi;

    $foto = upload($foto, 'admin/profile');
    if (is_string($foto)) {
        $stmt = $koneksi->prepare(dbInsert('users', ['username', 'password', 'role', 'status_user']));
        try {
            $stmt->execute([@$data['username'], md5(@$data['password']), 'admin', 'aktif']);
            $userId = $koneksi->lastInsertId();
            $stmt = null;
            $stmt = $koneksi->prepare(dbInsert('admin', ['user_id', 'nama', 'no_hp', 'email', 'foto']));
            $stmt->execute([$userId, @$data['nama'], @$data['no_hp'], @$data['email'], $foto]);
            if ($stmt->rowCount() == 1) {
                return true;
                die;
            }
            return false;
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }
}

function updateProfile($data = [], $foto = null, $profile = null)
{

    global $koneksi;

    $upFoto = "";
    $userId = $_SESSION['user']->user_id;
    $lokasi = ($profile == "admin") ? "admin/profile" : "alumni/profile";
    if ($profile == 'admin') {
        $updateRows = ['nama', 'no_hp', 'email'];
        $updateData = [@$data['nama'], @$data['no_hp'], @$data['email']];
    } else {
        $updateRows = ['nim', 'nama', 'email', 'tgl_lahir', 'jurusan', 'angkatan', 'pekerjaan', 'no_hp', 'alamat'];
        $updateData = [@$data['nim'], @$data['nama'], @$data['email'], @$data['tgl_lahir'], @$data['jurusan'], @$data['angkatan'], @$data['pekerjaan'], @$data['no_hp'], @$data['alamat']];
    }
    if ($foto['error'] == 0) {
        $upFoto = upload($foto, $lokasi);
        if (is_string($upFoto)) {
            array_push($updateData, $upFoto);
            array_push($updateRows, 'foto');
        }
    }
    $res = $koneksi->prepare(dbUpdate($profile, $updateRows, 'user_id'));
    array_push($updateData, $userId);
    $res->execute($updateData);
    return $userId;
}
