<?php

if (isset($_POST['tambah'])) {
    $res = insertAdmin($_POST, $_FILES['foto']);
    if ($res) {
        $message = "Berhasil";
        myLog(['id' => $_SESSION['user']->user_id, 'aktivitas' => 'Berhasil menambah admin']);
    } else if ($res == false) {
        $message = "Gagal";
    } else {
        myLog(['id' => $_SESSION['user']->user_id, 'aktivitas' => 'Gagal menambah admin']);
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
        <form action="" method="post" enctype="multipart/form-data">
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
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto">
            </div>
            <div class="form-group">
                <input type="submit" value="Tambah" name="tambah" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>