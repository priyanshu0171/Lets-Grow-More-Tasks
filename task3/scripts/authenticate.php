<?php
$expire = 60*60*30*30*24*30;
include "../classes/dbh.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin = new Admin();
    $adminData = $admin -> getAdmin();
    foreach($adminData as $data) {
        if ($data['email'] == $email && $data['password'] == $password) {
            setcookie('admin', hash('sha256', $email), $expire, '/');
            setcookie('admin_id', $data['id'],  $expire, '/');
            header("Location: ../admin/");
        } else {
            header("Location: ../index.php?msg=Wrong Credentials&type=error");
        }
    }
}
if (isset($_POST['logout'])) {
    $expire = 60*60*30*30*24*30;
    setcookie('admin','', $expire, '/');
    setcookie('admin_id', '',  $expire, '/');
    header("Location: ../index.php");
}
