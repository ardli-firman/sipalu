<?php

function dbGet($table = null)
{
    $res = "SELECT * FROM $table";

    return $res;
}

function dbGetWhere($table = null, $where = [])
{
    $res = "SELECT * FROM $table WHERE " . array_keys($where)[0] . "= '" . $where[array_keys($where)[0]] . "'";
    return $res;
}

function dbInsert($table = null, $row = [])
{
    $jumlah_row = sizeof($row);
    $res = "INSERT INTO $table (";

    foreach ($row as $value) {
        $res .= $value . ',';
    }

    $hasil = rtrim($res, ',');
    $hasil .= ') VALUES (';

    for ($i = 1; $i <= $jumlah_row; $i++) {
        $hasil .= '?,';
    }
    $hasil_akhir = rtrim($hasil, ',');
    $hasil_akhir .= ')';
    return $hasil_akhir;
}

function dbUpdate($table = null, $row = [], $where = null)
{
    $string1 = "UPDATE $table SET ";

    foreach ($row as $key) {
        $string1 .= $key . ' = ? ,';
    }
    $string2 = rtrim($string1, ',');
    $string2 .= ' WHERE ' . $where . ' = ?';

    return $string2;
}

function dbDelete($table = null, $where = null)
{
    $string1 = "DELETE FROM $table WHERE ";
    $string1 .= $where . ' = ?';

    return $string1;
}
