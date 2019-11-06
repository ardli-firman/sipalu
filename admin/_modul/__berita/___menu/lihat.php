<?php
if (isset($_GET['id'])) {
    $artikel = getArtikel($_GET['id']);
}

if (isset($_POST['post'])) {
    $res = updateStatusArtikel($_POST);
    if ($res) {
        $message = "Berhasil diedit";
    } else if ($res == false) {
        $message = "Gagal diedit";
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
        <h3 class="box-title"> <i class="fa fa-file"></i> Lihat postingan</h3>
    </div>
    <div class="box-body">
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $artikel->id_artikel ?>">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" value="<?= $artikel->judul ?>">
            </div>
            <div class="form-group">
                <label for="sampul">Sampul</label>
                <img src="assets/foto/berita/sampul/<?= $artikel->sampul ?>" alt="" class="img-responsive" width="500px" height="300px">
            </div>
            <div class="form-group">
                <label for="jenis">Jenis postingan</label>
                <select type="text" name="jenis" class="form-control">
                    <option value="loker" <?= ($artikel->jenis == 'loker') ? 'selected' : ''  ?>>Loker</option>
                    <option value="artikel" <?= ($artikel->jenis == 'artikel') ? 'selected' : ''  ?>>Artikel</option>
                    <option value="berita" <?= ($artikel->jenis == 'berita') ? 'selected' : ''  ?>>Berita</option>
                </select>
            </div>
            <div class="box-body pad">
                <label for="isi">Isi</label>
                <textarea name="isi" id="editor-post" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $artikel->isi ?></textarea>
            </div>
            <input type="submit" value="diterima" name="post" class="btn btn-success">
            <input type="submit" value="ditolak" name="post" class="btn btn-danger">
        </form>
    </div>
</div>