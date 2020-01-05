<?php

$artikel = getArtikel($_GET['id']);

if (isset($_POST['post'])) {
    $res = updateArtikel($_POST, $_GET['id']);
    if ($res) {
        $message = "Berhasil mengedit postingan";
        $_SESSION['flash'] = $message;
        echo "<script>window.location.href = '?menu=posting'</script>";
    } else if ($res === false) {
        $message = "Gagal mengedit postingan";
        $_SESSION['flash'] = $message;
        echo "<script>window.location.href = '?menu=posting'</script>";
    } else {
        $message = $res;
        $_SESSION['flash'] = $message;
        echo "<script>window.location.href = '?menu=posting'</script>";
    }
    myLog(['id' => $_SESSION['user']->user_id, 'aktivitas' => $message]);
}
?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"> <i class="fa fa-file"></i> Edit postingan</h3>
    </div>
    <div class="box-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input value="<?= $artikel->judul ?>" type="text" name="judul" class="form-control">
            </div>
            <div class="form-group">
                <label for="jenis">Jenis postingan</label>
                <select type="text" name="jenis" class="form-control">
                    <option value="loker" <?= ($artikel->jenis == 'loker') ? 'selected' : '' ?>>Loker</option>
                    <option value="artikel" <?= ($artikel->jenis == 'artikel') ? 'selected' : '' ?>>Artikel</option>
                    <option value="berita" <?= ($artikel->jenis == 'berita') ? 'selected' : '' ?>>Berita</option>
                </select>
            </div>
            <div class="form-group">
                <img src="assets/foto/berita/sampul/<?= $artikel->sampul ?>" alt="" width="200px" height="200px">
            </div>
            <div class="form-group">
                <label for="sampul">Sampul</label>
                <input type="file" name="sampul" class="form-control">
                <code>kosongkan jika tidak ada</code>
            </div>
            <div class="box-body pad">
                <label for="isi">Isi</label>
                <textarea name="isi" id="editor-post" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $artikel->isi ?></textarea>
            </div>
            <input type="submit" value="Post" name="post" class="btn btn-success">
        </form>
    </div>
</div>