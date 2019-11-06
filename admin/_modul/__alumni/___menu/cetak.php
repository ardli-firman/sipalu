<?php
$alumnis = getAlumni('alumni');
?>
<table class="table">
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
                    <td><?= $alumni->alamat ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php

echo "<script>window.print(); setTimeout(function(){window.history.back()},3000)</script>";
