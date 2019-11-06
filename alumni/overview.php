<?php require_once '_partials/__side.php'; ?>
<?php $modul = @$_GET['menu']; ?>
<?php $aksi = @$_GET['aksi']; ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <?php
        switch ($modul) {
            case 'loker':
                switch ($aksi) {
                    case 'tambah':
                        require_once '_modul/__user/___menu/tambah.php';
                        break;
                    default:
                        require_once '_modul/__loker/view.php';
                        break;
                }
                break;
            case 'artikel':
                switch ($aksi) {
                    case 'tambah':
                        require_once '_modul/__artikel/___menu/tambah.php';
                        break;
                    case 'lihat':
                        require_once '_modul/__artikel/___menu/lihat.php';
                        break;

                    default:
                        require_once '_modul/__artikel/view.php';
                        break;
                }
                break;
            case 'diskusi':
                switch ($aksi) {
                        // case 'cetak':
                        //     require_once '_modul/__berita/___menu/cetak.php';
                        //     break;

                    default:
                        require_once '_modul/__diskusi/view.php';
                        break;
                }
                break;
            default:
                require_once '_modul/__dashboard/view.php';
                break;
        } ?>
    </section>
</div>
<?php require_once '_partials/__footer.php' ?>