<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once base_server() . 'vendor/autoload.php';
// require_once '../vendor/autoload.php';

function sendEmail($data = [], $konten)
{
    if ($konten == 'forgot-password') {
        $link = forgotPassword($data['id']);
        $content = "<b>Reset password silahkan klik <a href='{$link}'>disini</a></b>";
    } else if ($konten == 'aktivasi-akun') {
        if ($data['status'] == 'ditolak') {
            $content = "Akun anda gagal untuk diaktivasi silahkan registrasi ulang!";
        } else {
            $content = "<b>Selamat!</b> akun anda sudah aktif silahkan klik <a href='http://localhost/sipalu/home.php?menu=login'>disini</a> untuk login";
        }
    }

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "ardlifirman17@gmail.com";
        $mail->Password   = "ardli Firman1234";

        $mail->IsHTML(true);
        $mail->AddAddress($data['email'], $data['nama']);
        $mail->SetFrom("ardlifirman17@gmail.com", "SIPALU TEAM");
        $mail->Subject = "NOTIFIKASI SIPALU";
        $mail->msgHTML($content);
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    } catch (Exception $th) {
        return $mail->ErrorInfo;
    }
}

function forgotPassword($id)
{
    $code = "POLTEK_HARBER_SIPALU";
    $data['encode'] = urlencode(base64_encode($code));
    $link = "http://localhost/sipalu/home.php?menu=verifikasi&do=ganti-password&token=" . $data['encode'] . "&cred=" . urlencode(base64_encode($id));
    // $data['decode'] = base64_decode(urldecode($data['encode']));
    return $link;
}

// var_dump(sendEmail(['id' => 28, 'nama' => 'ardli firman', 'email' => 'estungtung59@gmail.com'], 'forgot-password'));
