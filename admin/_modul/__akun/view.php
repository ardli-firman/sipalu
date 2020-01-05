<?php

$user = getUser($_SESSION['user']->user_id);

if (isset($_POST['edit'])) {

    $res = updateAkun($_POST);
    if ($res === true) {
        $_SESSION['flash'] = 'Berhasil diubah';
        myLog(['id' => $_SESSION['user']->user_id, 'aktivitas' => 'Berhasil mengupdate akun']);
        echo "<script>window.location.href = '?menu=akun'</script>";
        die;
    } else {
        $_SESSION['flash'] = $res;
        echo "<script>window.location.href = '?menu=akun'</script>";
        die;
    }
}

?>
<div class="box box-success">
    <div class="box-header with-border">
        <?php if (isset($_SESSION['flash'])) : ?>
            <div class="alert alert-info">
                <?= $_SESSION['flash'] ?>
            </div>
        <?php endif;
        unset($_SESSION['flash']) ?>
        <h3 class="box-title"> <i class="fa fa-user"></i> Edit akun</h3>
    </div>
    <div class="box-body">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $user->id_user ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" value="<?= $user->username ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Edit" name="edit" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>