<?php
$artikels = getArtikelByUserId($_SESSION['user']->user_id);

if (isset($_POST['hapus'])) {
    $res = deleteArtikel($_POST['hapus']);
    if ($res === true) {
        $message = "Berhasil dihapus";
        $_SESSION['flash'] = $message;
        $artikels = getArtikelByUserId($_SESSION['user']->user_id);

        $res = null;
    } else {
        $message = $res;
        $_SESSION['flash'] = $message;
        $artikels = getArtikelByUserId($_SESSION['user']->user_id);

        $res = null;
    }
}

?>

<div class="box box-info">
    <div class="box-header with-border">
        <?php if (isset($_SESSION['flash'])) : ?>
            <div class="alert alert-info">
                <?= $_SESSION['flash'] ?>
            </div>
        <?php endif;
        unset($_SESSION['flash']) ?>
        <h3 class="box-title"> <i class="fa fa-file"></i> Berita</h3>
        <span style="float:right;">
            <a class="btn btn-primary" href="?menu=posting&aksi=tambah"><i class="fa fa-plus"></i> Post</a>
        </span>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped example">
            <thead>
                <tr class="text-center">
                    <th width="5%">NO</th>
                    <th>JUDUL</th>
                    <th>JENIS</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($artikels != false) : ?>
                    <?php $i = 0;
                    foreach ($artikels as $artikel) : ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $artikel->judul ?></td>
                            <td><?= $artikel->jenis ?></td>
                            <td><?= $artikel->status_artikel ?></td>
                            <td>
                                <a class="btn btn-xs bg-primary" href="?menu=posting&aksi=edit&id=<?= $artikel->id_artikel ?>"><i class="fa fa-pencil"></i>Edit</a>
                                <form method="post" action="">
                                    <button onclick="return confirm('Hapus ?')" id="btn-hapus" class="btn btn-xs bg-red" type="submit" name="hapus" value="<?= $artikel->id_artikel ?>"><i class="fa fa-trash"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>