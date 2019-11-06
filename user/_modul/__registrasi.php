<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'helper/database_helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'helper/upload_helper.php';


function doRegist($data)
{
    global $koneksi;

    try {
        $stmt = $koneksi->prepare(dbInsert('users', ['username', 'password', 'role', 'status_user']));
        $stmt->execute([@$data['username'], md5(@$data['password']), 'alumni', 'menunggu']);

        $userId = $koneksi->lastInsertId();
        $stmt = null;
        $stmt = $koneksi->prepare(dbInsert('alumni', ['user_id', 'nim', 'nama', 'email', 'tgl_lahir', 'jurusan', 'angkatan', 'pekerjaan', 'no_hp', 'alamat', 'foto_ijazah', 'foto']));
        if (@$_FILES['foto_ijazah']['error'] !== 4) {
            $foto = upload(@$_FILES['foto_ijazah'], 'alumni/ijazah');
            if ($foto != false) {
                $stmt->execute([$userId, @$data['nim'], @$data['nama'], @$data['email'], @$data['tgl_lahir'], @$data['jurusan'], @$data['angkatan'], @$data['pekerjaan'], @$data['no_hp'], @$data['alamat'], $foto, 'avatar.png']);
                return $stmt->rowCount();
            } else {
                return 'Error gambar';
            }
        } else {
            return 'Tidak ada gambar';
        }
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}
