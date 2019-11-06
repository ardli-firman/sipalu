<?php require_once '_partials/__side.php'; ?>
<?php require_once '_modul/__user/FunUser.php'; ?>
<?php require_once '_modul/__berita/FunBerita.php'; ?>
<?php $modul = @$_GET['menu']; ?>
<?php $aksi = @$_GET['aksi']; ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <?php
        switch ($modul) {
            case 'user':
                switch ($aksi) {
                    case 'tambah':
                        require_once '_modul/__user/___menu/tambah.php';
                        break;
                    default:
                        require_once '_modul/__user/view.php';
                        break;
                }
                break;
            case 'alumni':
                switch ($aksi) {
                    case 'cetak':
                        require_once '_modul/__alumni/___menu/cetak.php';
                        break;

                    default:
                        require_once '_modul/__alumni/view.php';
                        break;
                }
                break;
            case 'berita':
                switch ($aksi) {
                    case 'tambah':
                        require_once '_modul/__berita/___menu/tambah.php';
                        break;
                    case 'lihat':
                        require_once '_modul/__berita/___menu/lihat.php';
                        break;

                    default:
                        require_once '_modul/__berita/view.php';
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