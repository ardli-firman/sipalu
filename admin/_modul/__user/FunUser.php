<?php

require_once $_SERVER['DOCUMENT_ROOT'] . 'helper/database_helper.php';

function getAll()
{
    global $koneksi;

    $alumni = $koneksi->query(dbGet('users') . ' INNER JOIN alumni ON users.id_user = alumni.user_id')->fetchAll();
    $admin = $koneksi->query(dbGet('users') . ' INNER JOIN admin ON users.id_user = admin.user_id')->fetchAll();

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
        $res = $koneksi->prepare(dbDelete('users', 'id_user'));
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

function insertAdmin($data = [])
{
    global $koneksi;

    $stmt = $koneksi->prepare(dbInsert('users', ['username', 'password', 'role', 'status_user']));
    try {
        $stmt->execute([@$data['username'], md5(@$data['password']), 'admin', 'aktif']);
        $userId = $koneksi->lastInsertId();
        $stmt = null;
        $stmt = $koneksi->prepare(dbInsert('admin', ['user_id', 'nama', 'no_hp', 'email']));
        $stmt->execute([$userId, @$data['nama'], @$data['no_hp'], @$data['email']]);
        if ($stmt->rowCount() == 1) {
            return true;
            die;
        }
        return false;
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}
