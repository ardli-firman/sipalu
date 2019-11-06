<?php
$alumnis = getAlumni('alumni');
?>
<div class="box box-info">
    <div class="box-header with-border">
        <?php if (isset($message)) : ?>
            <div class="alert alert-info">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <h3 class="box-title"> <i class="fa fa-users"></i> Data Alumni</h3>
        <span style="float:right;">
            <a class="btn btn-primary" href="?menu=alumni&aksi=cetak"><i class="fa fa-print"></i> Cetak Data</a>
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
                    <th>ALAMAT</th>
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
                                <?= $alumni->alamat ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>