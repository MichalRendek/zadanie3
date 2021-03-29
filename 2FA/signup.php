<?php
require_once '../config.php';
require_once 'PHPGangsta/GoogleAuthenticator.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
$qr_code = $_POST['qr_code'];
$secret_code = $_POST['secret_code'];

$ga = new PHPGangsta_GoogleAuthenticator();
$result = $ga->verifyCode($secret_code, $qr_code);
if ($result == 1) {
    try {
        $query = "INSERT INTO `user`(`name`, `email`) VALUES ('".$name."','".$email."')";
        $stmt = $db->query($query);
        $query = "INSERT INTO `account`(`user_id`, `type`, `password`, `secret_code`) VALUES (".$db->lastInsertId().",'2fa','".$password."','".$secret_code."')";
        $stmt = $db->query($query);
    } catch (Exception $e) {
        echo $e;
    }
    echo 'success';
} else {
    echo 'failed';
}