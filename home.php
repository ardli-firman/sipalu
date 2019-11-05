<?php
require_once 'config/Koneksi.php';
@$menu = $_GET['menu']; ?>
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
                        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">About</a></li>
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li> -->
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
        default:
            # code...
            break;
    }
    ?>
</body>

</html>