<?php
require_once 'admin/_modul/__user/FunUser.php';
require_once 'helper/email_helper.php';

$res = getAll();

if (isset($_POST['email'])) {
    foreach ($res as $val) {
        if ($val->email == $_POST['email']) {
            $data['id'] = $val->id_user;
            $data['email'] = $val->email;
            $data['nama'] = $val->nama;
            break;
        } else {
            $data = [];
            @$_SESSION['flash'] = "Email tidak ditemukan";
        }
    }

    if ($data != null) {
        $res = sendEmail($data, 'forgot-password');
        if ($res === true) {
            $_SESSION['flash'] = "Silahkan cek email anda";
            echo "<script>location.href= 'home.php?menu=login'</script>";
            die;
        } else {
            $_SESSION['flash'] = "Gagal verifikasi data";
            echo "<script>location.href= 'home.php?menu=login'</script>";
            die;
        }
    }
}
?>
<div class="row">
    <div class="login-box">
        <div class="login-logo">
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <?php if (isset($_SESSION['flash'])) : ?>
                <div class="alert alert-info">
                    <?= $_SESSION['flash'] ?>
                </div>
            <?php endif;
            unset($_SESSION['flash']) ?>
            <p class="login-box-msg" style="font-size:100%;">Masukkan E-mail</p>
            <form action="" method="post" id="form-login">
                <div class="form-group has-feedback">
                    <input type="text" name="email" class="form-control" placeholder="email" required="" autocomplete="" autofocus="">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block btn-flat" style="font-size: 15px;">Lupa password <i class="glyphicon glyphicon-log-in"></i></button>
            </form>
            <br>
            <p class="text-center">
                <a href="?menu=login">Login</a>
            </p>
        </div>
        <!-- /.login-box-body -->-
    </div>
</div>