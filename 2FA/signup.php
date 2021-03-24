<?php
require_once '../config.php';
require_once 'PHPGangsta/GoogleAuthenticator.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$qr_code = $_POST['qr_code'];
$secret_code = $_POST['secret_code'];

var_dump($_POST);
$ga = new PHPGangsta_GoogleAuthenticator();
$result = $ga->verifyCode($secret_code, $qr_code);
var_dump($result);
if ($result == 1) {
    $query = "INSERT INTO `user`(`name`, `email`) VALUES ('".$name."','".$email."')";
    $stmt = $db->query($query);
    $query = "INSERT INTO `account`(`user_id`, `type`, `password`, `secret_code`) VALUES (".$db->lastInsertId().",'2fa','".$password."','".$secret_code."')";
    $stmt = $db->query($query);
    echo 'success';
} else {
    echo 'failed';
}