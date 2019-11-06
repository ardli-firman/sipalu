<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . 'config/Koneksi.php';
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