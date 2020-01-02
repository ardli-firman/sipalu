<?php
date_default_timezone_set('Asia/jakarta');
@session_start();
require_once 'config/Koneksi.php';
require_once 'helper/url_helper.php';
require_once 'helper/database_helper.php';
require_once 'helper/log_helper.php';
@$menu = $_GET['menu'];
@$extended = $_GET['do'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'partials/_header.php'; ?>
</head>

<body class="skin-green layout-top-nav">
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="../../index2.html" class="navbar-brand">
                        <b>Sistem Informasi Pendataan Alumni</b></a> <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="./">Home <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div>
                <div class="navbar-custom-menu">
                    <div class="nav navbar-nav">
                        <li class="pull-left"><a href="?menu=login">Login <span class="sr-only">(current)</span></a></li>
                        <li class="pull-left"><a href="?menu=registrasi">Registrasi <span class="sr-only">(current)</span></a></li>
                    </div>
                </div>
                </ul>
                </li>
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <?php
    switch ($menu) {
        case 'registrasi':
            require_once 'registrasi.php';
            break;
        case 'login':
            require_once 'login.php';
            break;
        case 'lupa-password':
            require_once 'lupa_password.php';
            break;
        case 'verifikasi':
            require_once 'verifikasi.php';
            break;
        default:
            require_once 'welcome.php';
            break;
    }
    ?>
</body>

</html>