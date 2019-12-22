<?php

$artikels = getAllArtikelByJenis('artikel', "LIMIT 5");

?>

<section class="content">
    <div class="row">
        <div class="col-xs-3">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= sizeof(getAlumni()) ?></h3>

                    <p>Alumni</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="?menu=alumni" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-xs-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Artikel terbaru</h3>

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
                        <!-- /.item -->
                        <!-- <li class="item">
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Buka bersama alumni angkatan 2018</a>
                            </div>
                        </li> -->
                        <!-- /.item -->
                        <!-- <li class="item">
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Acara Buka bersama alumni angkatan 2017</a>
                            </div>
                        </li> -->
                        <!-- /.item -->
                        <!-- <li class="item">
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Acara Buka bersama alumni angkatan 2016</a>
                            </div>
                        </li> -->
                        <!-- /.item -->
                    </ul>
                </div>
                <!-- /.box-body -->
                <!-- <div class="box-footer text-center">
                    <a href="?menu=berita" class="uppercase">Lihat semua artikel</a>
                </div> -->
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
</section>