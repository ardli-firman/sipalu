<?php
$users = getAll();

if (@$_POST['yes'] != null || @$_POST['no'] != null) {
    $res = updateStatusAkun($_POST);
    if ($res === true) {
        $message = "Berhasil diubah";
        $res = null;
    } else {
        $message = $res;
        $res = null;
    }
}

if (isset($_POST['hapus'])) {
    $res = deleteAkun($_POST['hapus']);
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
        <h3 class="box-title"> <i class="fa fa-users"></i> Data User</h3>
        <span style="float:right;">
            <a class="btn btn-primary" href="?menu=user&aksi=tambah"><i class="fa fa-plus"></i> Admin</a>
        </span>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped example">
            <thead>
                <tr class="text-center">
                    <th width="5%">NO</th>
                    <th>USERNAME</th>
                    <th>ROLE</th>
                    <th>STATUS AKUN</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users != false) : ?>
                    <?php $i = 0;
                        foreach ($users as $user) : ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $user->username ?></td>
                            <td><?= $user->role ?></td>
                            <td><?= $user->status_user ?></td>
                            <td>
                                <?php if ($user->role == 'alumni') : ?>
                                    <button data-foto="<?= $user->foto_ijazah ?>" data-angkatan="<?= $user->angkatan ?>" data-id="<?= $user->id_user ?>" data-nama="<?= $user->nama ?>" data-toggle="modal" data-target="#modal-edit" id="btn-edit" class="btn btn-xs bg-primary"><i class="fa fa-edit"></i>Edit</button>
                                <?php endif; ?>
                                <form method="post" action="">
                                    <button onclick="return confirm('Hapus ?')" id="btn-hapus" class="btn btn-xs bg-red" type="submit" name="hapus" value="<?= $user->id_user ?>"><i class="fa fa-trash"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="modal-edit" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-user"></i> Alumni</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="form-edit" action="">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input name="nama" type="text" value="" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="Foto ijazah">Foto ijazah</label>
                        <img src="" alt="" class="img-responsive">
                    </div>
                    <div class="form-group">
                        <label for="Angkatan">Angkatan</label>
                        <input type="text" name="angkatan" class="form-control" disabled>
                    </div>
                    <input type="submit" value="aktif" name="yes" class="btn btn-success">
                    <input type="submit" value="ditolak" name="no" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-edit-admin" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-user"></i> Admin</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="form-edit" action="">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input name="nama" type="text" value="" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="Foto ijazah">Foto ijazah</label>
                        <img src="" alt="" class="img-responsive">
                    </div>
                    <div class="form-group">
                        <label for="Angkatan">Angkatan</label>
                        <input type="text" name="angkatan" class="form-control" disabled>
                    </div>
                    <input type="submit" value="aktif" name="yes" class="btn btn-success">
                    <input type="submit" value="ditolak" name="no" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#modal-edit').on('show.bs.modal', (e) => {
        let data = $(e.relatedTarget).data();
        $("#form-edit [name='id']").val(data.id);
        $("#form-edit [name='nama']").val(data.nama);
        $("#form-edit [name='angkatan']").val(data.angkatan);
        $("#form-edit img").attr("src", "assets/foto/alumni/ijazah/" + data.foto);
    })
</script>