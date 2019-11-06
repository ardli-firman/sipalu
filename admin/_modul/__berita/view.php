<?php
$artikels = getAllArtikel();

if (isset($_POST['hapus'])) {
    $res = deleteArtikel($_POST['hapus']);
    if ($res === true) {
        $message = "Berhasil dihapus";
        $res = null;
    } else {
        $message = $res;
        $res = null;
    }
}
?>
<div class="box box-info">
    <div class="box-header with-border">
        <?php if (isset($message)) : ?>
            <div class="alert alert-info">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <h3 class="box-title"> <i class="fa fa-file"></i> Berita</h3>
        <span style="float:right;">
            <a class="btn btn-primary" href="?menu=berita&aksi=tambah"><i class="fa fa-plus"></i> Post</a>
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
                                <!-- <button data-id="<?= $artikel->id_artikel ?>" data-judul="<?= $artikel->judul ?>" data-toggle="modal" data-target="#modal-view-artikel" id="btn-edit" class="btn btn-xs bg-primary"><i class="fa fa-eye"></i>Lihat</button> -->
                                <a class="btn btn-xs bg-primary" href="?menu=berita&aksi=lihat&id=<?= $artikel->id_artikel ?>"><i class="fa fa-eye"></i>Lihat</a>
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

<div id="modal-view-artikel" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-file"></i> Artikel</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-view-artikel">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="judul">judul</label>
                        <input type="text" name="judul" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="isi">Isi</label>
                        <textarea name="isi" id="isi-post" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <input type="text" name="jenis" class="form-control" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        var editor = $("#form-view-artikel textarea").wysihtml5();
        $('#modal-view-artikel').on('show.bs.modal', function(e) {
            let data = $(e.relatedTarget).data();
            $.ajax({
                url: 'admin/_modul/__berita/___ajax/getArtikel.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'id': data.id
                },
                success: (res) => {
                    $("#form-view-artikel [name='id']").val(res.id_artikel);
                    $("#form-view-artikel [name='judul']").val(res.judul);
                    $("#form-view-artikel [name='jenis']").val(res.jenis);

                }
            });
        })
        $('#modal-view-artikel').on('hidden', function() {
            // $("#form-view-artikel textarea").val();
        });
    })
</script>