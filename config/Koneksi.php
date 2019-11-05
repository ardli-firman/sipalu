<?php

try {
    $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //make the default fetch be an associative array
    ];
    $koneksi = new PDO('mysql:host=localhost;dbname=sipalu', 'root', '', $options);
} catch (PDOException $th) {
    echo "Koneksi bermasalah " . $th->getMessage();
    die;
}
