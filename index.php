<?php
date_default_timezone_set('Asia/jakarta');
@session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/sipalu/helper/url_helper.php';
require_once base_server() . 'config/Koneksi.php';
require_once 'helper/log_helper.php';
@$sesi = $_SESSION['user']->role;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'partials/_header.php'; ?>
</head>

<body>
    <?php if ($sesi == 'admin') {
        require_once 'admin/overview.php';
    } else if ($sesi == 'alumni') {
        require_once 'alumni/overview.php';
    } else {
        require_once 'home.php';
    } ?>
    <?php require_once 'partials/_footer.php'; ?>
</body>

</html>