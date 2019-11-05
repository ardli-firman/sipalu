<?php
$alumnis = getAll('alumni');
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
                    <th>NAMA</th>
                    <th>JURUSAN</th>
                    <th>ANGKATAN</th>
                    <th>NO HP</th>
                    <th>EMAIL</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($alumnis != false) : ?>
                    <?php $i = 0;
                        foreach ($alumnis as $alumni) : ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $alumni->nama ?></td>
                            <td><?= $alumni->jurusan ?></td>
                            <td><?= $alumni->angkatan ?></td>
                            <td><?= $alumni->no_hp ?></td>
                            <td><?= $alumni->email ?></td>
                            <td>
                                <button data-foto="<?= $alumni->foto_ijazah ?>" data-angkatan="<?= $alumni->angkatan ?>" data-id="<?= $alumni->id_user ?>" data-nama="<?= $alumni->nama ?>" data-toggle="modal" data-target="#modal-edit" id="btn-edit" class="btn btn-xs bg-primary"><i class="fa fa-edit"></i>Edit</button>
                                <form method="post" action="">
                                    <button onclick="return confirm('Hapus ?')" id="btn-hapus" class="btn btn-xs bg-red" type="submit" name="hapus" value="<?= $alumni->id_user ?>"><i class="fa fa-trash"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>