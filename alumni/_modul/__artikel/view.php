<?php

$artikels = getAllArtikelByJenis($_GET['jenis']);

?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= strtoupper($_GET['jenis']) ?></h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <?php foreach ($artikels as $artikel) : ?>
                <li class="item">
                    <div class="product-img">
                        <img src="assets/foto/berita/sampul/<?= $artikel->sampul ?>" alt="Product Image">
                    </div>
                    <div class="product-info">
                        <a href="?menu=artikel&aksi=lihat&id=<?= $artikel->id_artikel ?>" class="product-title"><?= $artikel->judul ?>
                            <span class="label label-warning pull-right"><?= $artikel->tanggal ?></span>
                        </a>
                        <span style="font-size: 12px ; margin-top: 5px" class="product-description">
                            <?= strip_tags($artikel->isi) ?>
                        </span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- /.box-footer -->
</div>