<?php
if (isset($_POST['submit'])) {
    $res = $koneksi->query(dbGetWhere('users', ['username' => $_POST['username']]))->fetch();
    if ($res === false) {
        $message = "Username tidak ada";
        echo $message;
    } else {
        $user = $koneksi->query(dbGetWhere($res->role, ['user_id' => $res->id_user]))->fetch();
        $user->role = $res->role;
        if (md5($_POST['password']) != $res->password) {
            $message = "password salah";
            echo $message;
        } else {
            $_SESSION['user'] = $user;
            echo "<script>location.reload()</script>";
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