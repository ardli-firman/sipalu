<?php require_once '_partials/__side.php'; ?>
<?php require_once '_modul/__user/FunUser.php'; ?>
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
                        // case 'hapus':

                        //     break;
                    default:
                        require_once '_modul/__user/view.php';
                        break;
                }
                break;
            case 'alumni':
                switch ($aksi) {
                    case 'value':
                        # code...
                        break;

                    default:
                        require_once '_modul/__alumni/view.php';
                        break;
                }
            default:

                break;
        } ?>
    </section>
</div>
<?php require_once '_partials/__footer.php' ?>