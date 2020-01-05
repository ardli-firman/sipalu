<?php

if (@$_GET['token'] === null || @$_GET['cred'] === null || @$_GET['do'] === null) {
    echo "<script>location.href= 'home.php'</script>";
    die;
}

$key = "POLTEK_HARBER_SIPALU";

$aksi = $_GET['do'];
$token = base64_decode($_GET['token']);
$id = base64_decode($_GET['cred']);

if ($token !== $key) {
    echo "<script>location.href= 'home.php'</script>";
    die;
}

if ($aksi == 'ganti-password') {
    $res = $koneksi->query(dbGetWhere('users', ['id_user' => $id]) . " AND deleted='0'")->fetch();
    if ($res === false) {
        echo "<script>location.href= 'home.php'</script>";
        die;
    }
} else {
    echo "<script>location.href= 'home.php'</script>";
    die;
}

if (isset($_POST['forgot-password'])) {
    $password = md5($_POST['password']);
    $id = $_POST['id'];
    $res = $koneksi->prepare(dbUpdate('users', ['password'], 'id_user'));
    $res->execute([$password, $id]);
    $_SESSION['flash'] = "Password berhasil diganti";
    myLog(['id' => $id, 'aktivitas' => 'Mengganti password dengan email']);
    echo "<script>location.href= 'home.php?menu=login'</script>";
    die;
}

?>

<div class="row">
    <div class="login-box">
        <div class="login-logo">
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg" style="font-size:100%;">Masukkan password baru</p>
            <form action="" method="post" id="form-login">
                <div class="form-group has-feedback">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="" autocomplete="" autofocus="">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <button type="submit" name="forgot-password" class="btn btn-lg btn-secondary btn-block btn-flat" style="font-size: 15px;">Reset password <i class="glyphicon glyphicon-log-in"></i></button>
            </form>
            <br>
        </div>
        <!-- /.login-box-body -->-
    </div>
</div>