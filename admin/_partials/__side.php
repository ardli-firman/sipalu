<?php
require_once base_server() . 'helper/database_helper.php';
$user = $_SESSION['user'];
if (isset($_GET['signout'])) {
    myLog(['id' => $user->user_id, 'aktivitas' => 'Telah Logout']);
    $_SESSION = [];
    echo "<script>location.reload()</script>";
}

if (isset($_POST['simpanProfile'])) {
    $userId = updateProfile($_POST, $_FILES['foto'], 'admin');
    $_SESSION = [];
    $res = $koneksi->query(dbGetWhere('admin', ['user_id' => $userId]))->fetch();
    $res->role = 'admin';
    $_SESSION['user'] = $res;
    myLog(['id' => $userId, 'aktivitas' => 'Memperbaharui profile']);
    echo "<script>location.href = '/sipalu/'</script";
}

?>

<body class="hold-transition skin-blue sidebar-mini fixed skin-green">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b><i class="fa fa-star-o"></i></b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>SIPALU</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="assets/foto/admin/profile/<?= $user->foto ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="assets/foto/admin/profile/<?= $user->foto ?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?= $user->nama ?>
                                        <small></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <button href="" data-toggle="modal" data-target="#modal-profile" class="btn btn-default btn-flat">Profile</button>
                                    </div>
                                    <div class="pull-right">
                                        <a href="?signout=true" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="assets/foto/admin/profile/<?= $user->foto ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <!-- Nama -->
                        <p> <?= $user->nama ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="?menu=dashboard">
                            <i class="fa fa-th"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="?menu=user">
                            <i class="fa fa-users"></i> <span>User</span>
                        </a>
                    </li>
                    <li>
                        <a href="?menu=diskusi">
                            <i class="fa fa-comments-o"></i> <span>Diskusi</span>
                        </a>
                    </li>
                    <li>
                        <a href="?menu=berita">
                            <i class="fa fa-link"></i> <span>Berita</span>
                        </a>
                    </li>
                    <li>
                        <a href="?menu=alumni">
                            <i class="fa fa-user"></i> <span>Alumni</span>
                        </a>
                    </li>
                    <li>
                        <a href="?menu=akun">
                            <i class="fa fa-lock"></i><span>Akun saya</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
    </div>
    <div id="modal-profile" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-user"></i> Profile</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group text-center">
                        <img src="assets/foto/admin/profile/<?= $user->foto ?>" alt="" class="img-circle">
                    </div>
                    <form method="post" action="" enctype="multipart/form-data" id="form-registrasi">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama" name="nama" value="<?= $user->nama ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $user->email ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="No Hp" name="no_hp" value="<?= $user->no_hp ?>">
                        </div>
                        <div class="form-group">
                            <label for="ijazah">Foto</label>
                            <input type="file" name="foto" id="" class="form-control">
                        </div>
                        <input type="submit" value="Simpan" class="btn btn-primary" name="simpanProfile">
                    </form>
                </div>
            </div>
        </div>
    </div>