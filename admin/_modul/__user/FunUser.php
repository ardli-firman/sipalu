<?php

require_once base_server() . 'helper/database_helper.php';
require_once base_server() . 'helper/email_helper.php';

function getAll()
{
    global $koneksi;

    $alumni = $koneksi->query(dbGet('users') . " INNER JOIN alumni ON users.id_user = alumni.user_id WHERE users.deleted='0'")->fetchAll();
    $admin = $koneksi->query(dbGet('users') . " INNER JOIN admin ON users.id_user = admin.user_id WHERE users.deleted='0'")->fetchAll();

    $res = array_merge($alumni, $admin);
    return $res;
}

function getUser($id = null)
{
    global $koneksi;

    $user = $koneksi->query(dbGetWhere('users', ['id_user' => $id]))->fetch();
    return $user;
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
    $time = date('Y-m-d H:i:s');

    $user = $koneksi->query(dbGetWhere('alumni', ['user_id' => $data['id']]))->fetch();

    $res = $koneksi->prepare(dbUpdate('users', ['status_user', 'modified_by', 'modified_at'], 'id_user'));
    if (isset($data['yes'])) {
        $status = $data['yes'];
        sendEmail(['status' => $status, 'email' => $user->email, 'nama' => $user->nama], 'aktivasi-akun');
    } else {
        $status = $data['no'];
        sendEmail(['status' => $status, 'email' => $user->email, 'nama' => $user->nama], 'aktivasi-akun');
    }
    $res->execute([$status, $_SESSION['user']->user_id, $time, $data['id']]);
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

    if ($foto['error'] == 4) {
        $foto = 'avatar.png';
    } else {
        $foto = upload($foto, 'admin/profile');
    }

    if (is_string($foto)) {
        $stmt = $koneksi->prepare(dbInsert('users', ['username', 'password', 'role', 'status_user', 'created_by', 'modified_by']));
        try {
            $stmt->execute([@$data['username'], md5(@$data['password']), 'admin', 'aktif', $_SESSION['user']->user_id, $_SESSION['user']->user_id]);
            $userId = $koneksi->lastInsertId();
            $stmt = null;
            $stmt = $koneksi->prepare(dbInsert('admin', ['user_id', 'nama', 'no_hp', 'email', 'foto', 'created_by', 'modified_by']));
            $stmt->execute([$userId, @$data['nama'], @$data['no_hp'], @$data['email'], $foto, $_SESSION['user']->user_id, $_SESSION['user']->user_id]);
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
    $time = date('Y-m-d H:i:s');

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
    array_push($updateRows, 'modified_by', 'modified_at');
    array_push($updateData, $_SESSION['user']->user_id, $time);
    $res = $koneksi->prepare(dbUpdate($profile, $updateRows, 'user_id'));
    array_push($updateData, $userId);
    $res->execute($updateData);
    return $userId;
}

function updateAkun($data = null)
{
    global $koneksi;
    $time = date('Y-m-d H:i:s');


    $updateRows = ['username'];
    $updateData = [@$data['username']];

    if ($data['password'] !== "") {
        $password = md5($data['password']);
        array_push($updateRows, 'password');
        array_push($updateData, $password);
    }
    array_push($updateRows, 'modified_by', 'modified_at');
    $stmt = $koneksi->prepare(dbUpdate('users', $updateRows, 'id_user'));
    array_push($updateData, $_SESSION['user']->user_id, $time, $data['id']);
    try {
        return $stmt->execute($updateData);
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}
