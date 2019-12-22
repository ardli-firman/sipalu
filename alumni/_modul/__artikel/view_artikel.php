<?php

$artikel = getArtikel($_GET['id']);

?>

<div class="box no-border">
    <div class="container">
        <div class="box-header">
            <h1><?= $artikel->judul ?></h1><span class="badge badge-warning"><?= $artikel->jenis ?></span>
            <span style="font-size: 12px">Diposting tanggal : <?= $artikel->tanggal ?></i></span>
        </div>
        <div class="box-body">
            <div class="">
                <img src="assets/foto/berita/sampul/<?= $artikel->sampul ?>" height="200px" class="img-responsive">
            </div>
            <p><?= $artikel->isi ?></p>
        </div>
    </div>
</div>