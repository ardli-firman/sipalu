<?php
require_once 'user/_modul/__registrasi.php';
if (isset($_POST['daftar'])) {
    $res = doRegist($_POST);
    if ($res == 1) {
        $status = true;
    } else {
        $status = $res;
    }
}
?>
<div class="box register-box box-success">
    <?php if (isset($status)) : ?>
        <div class="alert alert-<?= ($status) ? 'success' : 'danger'  ?>">
            <?= ($status) ? 'Silahkan cek email' : $status ?>
        </div>
    <?php endif; ?>
    <div class="box-header">
        <h3>Registrasi</h3>
    </div>
    <div class="box-body">
        <form method="post" action="" enctype="multipart/form-data" id="form-registrasi">
            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="NIM" name="nim">
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama" name="nama">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tanggal Lahir" name="tgl_lahir" id="datepicker">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Jurusan" name="jurusan">
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Angkatan" name="angkatan">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Pekerjaan" name="pekerjaan">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="No Hp" name="no_hp">
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Alamat" name="alamat"></textarea>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="ijazah">Foto ijazah</label>
                <input type="file" name="foto_ijazah" id="" class="form-control">
            </div>
            <input type="submit" value="Daftar" class="btn btn-primary" name="daftar">
        </form>
    </div>
</div>
<!-- <script>
    $('#form-registrasi').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '',
            method: 'post',
            processData: false,
            contentType: false,
            data: new FormData(this),
            success: (result) => {
                console.log(result);
            }
        })
    })
</script> -->