<?php

if (isset($_POST['tambah'])) {
    $res = insertAdmin($_POST);
    if ($res) {
        $message = "Berhasil";
    } else if ($res == false) {
        $message = "Gagal";
    } else {
        $message = $res;
    }
}
?>
<div class="box box-success">
    <div class="box-header with-border">
        <?php if (isset($message)) : ?>
            <div class="alert alert-info">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <h3 class="box-title"> <i class="fa fa-user"></i> Tambah admin</h3>
    </div>
    <div class="box-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">E - mail</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Tambah" name="tambah" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>