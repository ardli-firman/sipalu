<?php
if (isset($_POST['submit'])) {
    $res = $koneksi->query(dbGetWhere('users', ['username' => $_POST['username']]))->fetch();
    if ($res === false) {
        $_SESSION['flash'] = "Username tidak ada";
    } else {
        $status = $koneksi->query("SELECT status_user FROM users WHERE id_user=$res->id_user AND status_user='aktif' AND deleted='0'")->fetch();
        if ($status) {
            $user = $koneksi->query(dbGetWhere($res->role, ['user_id' => $res->id_user]))->fetch();
            $user->role = $res->role;
            if (md5($_POST['password']) != $res->password) {
                $_SESSION['flash'] = "password salah";
            } else {
                $stmt = $koneksi->prepare(dbUpdate('users', ['last_login'], 'id_user'));
                $timestamp = date('Y-m-d H:i:s');
                if ($stmt->execute([$timestamp, $res->id_user])) {
                    $_SESSION['user'] = $user;
                    myLog(['id' => $res->id_user, 'aktifitas' => 'Berhasil login']);
                    echo "<script>location.href= './'</script>";
                    die;
                }
            }
        } else {
            $_SESSION['flash'] = "Email / Password salah";
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
            <?php if (@$_SESSION['flash'] != null) : ?>
                <div class="alert alert-info">
                    <?= $_SESSION['flash'] ?>
                </div>
            <?php endif;
            unset($_SESSION['flash']) ?>
            <p class="login-box-msg" style="font-size:100%;">Masukkan Username dan Password</p>
            <form action="" method="post" id="form-login">
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="" autocomplete="" autofocus="">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="" autocomplete="off">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block btn-flat" style="font-size: 15px;">Login <i class="glyphicon glyphicon-log-in"></i></button>
            </form>
            <br>
            <p class="text-center">
                <a href="?menu=lupa-password">Lupa password ?</a>
            </p>
        </div>
        <!-- /.login-box-body -->-
    </div>
</div>
<script>
    // $(function() {
    //     $('#form-login').submit(function(e) {
    //         e.preventDefault();
    //         $.ajax({});
    //     })
    // })
</script>