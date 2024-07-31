<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'users.php';

$user = new UserNew();
$user->login = $_POST['user_login'] ?? '';
$user->password = $_POST['user_pass'] ?? '';
$user->password_repeat = $_POST['user_pass_repeat'] ?? '';
$user->name = $_POST['user_name'] ?? '';
$user->email = $_POST['user_email'] ?? '';

$ui = new UserInspector($user);
$ui->checkRules();

if (!$ui->hasBrokenRules()) {
    $user->sessionUnset();
    addUser($user);
} 
else 
{
    flash($ui->getBrokenRulesAsString('<br>'));
    $user->sessionSave();
}

header('Location: page_register.php');