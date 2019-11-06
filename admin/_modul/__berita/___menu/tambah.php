<?php

if (isset($_POST['post'])) {
    $res = insertPostingan($_POST);
    if ($res) {
        $message = "Berhasil ditambahkan";
    } else if ($res == false) {
        $message = "Gagal ditambahkan";
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
        <h3 class="box-title"> <i class="fa fa-file"></i> Tambah postingan</h3>
    </div>
    <div class="box-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control">
            </div>
            <div class="form-group">
                <label for="jenis">Jenis postingan</label>
                <select type="text" name="jenis" class="form-control">
                    <option value="loker">Loker</option>
                    <option value="artikel">Artikel</option>
                    <option value="berita">Berita</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sampul">Sampul</label>
                <input type="file" name="sampul" class="form-control">
                <code>kosongkan jika tidak ada</code>
            </div>
            <div class="box-body pad">
                <label for="isi">Isi</label>
                <textarea name="isi" id="editor-post" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
            <input type="submit" value="Post" name="post" class="btn btn-success">
        </form>
    </div>
</div>