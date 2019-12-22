<?php

function base_url()
{
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
        "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/sipalu/";

    return $link;
}

function base_server()
{
    $path = $_SERVER['DOCUMENT_ROOT'] . "/sipalu/";

    return $path;
}
