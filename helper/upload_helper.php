<?php

function upload($file = null, $lokasi = null)
{
    //Mengambil data gambar
    $namaFile   = $file['name'];
    $ukuranFile = $file['size'];
    $error      = $file['error'];
    $tmpName    = $file['tmp_name'];

    //mengecek error jika gambar belum di masukkan
    if ($error === 4) {
        echo "<script>
					alert('Pilih gambar');
							</script>";
        return false;
    }

    //cek apakah yang di upload adalah gambar
    $valid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    //mengambil array yang di belakang dan mengubahnya lowercase
    $ekstensi = strtolower(end($ekstensiGambar));
    //in array di gunakan untuk mencari ekstensi di dalam ekstensi valid
    if (!in_array($ekstensi, $valid)) {
        echo "<script>
					alert('Yang anda upload bukan gambar');
							</script>";

        return false;
    }

    //Mengecek ukuran
    if ($ukuranFile > 1000000) {
        echo "<script>
					alert('Ukuran gambar terlalu besar');
							</script>";
        return false;
    }

    //Setelah dicek gambar di upload
    //genererate nama baru agar tidak menimpa file yang sama
    $namaFileBaru = uniqid();
    // sambung
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;

    move_uploaded_file($tmpName, 'assets/foto/' . $lokasi . '/' . $namaFileBaru);

    return $namaFileBaru;
}
