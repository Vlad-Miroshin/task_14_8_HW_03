<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR.'boot.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'users.php';

$user = new UserNew();
$user->login = $_POST['user_login'] ?? '';
$user->password = $_POST['user_pass'] ?? '';

$ui = new LoginInspector($user);
$ui->checkRules();

if ($ui->hasBrokenRules()) {
    flash($ui->getBrokenRulesAsString('<br>'));
    $user->sessionSave();

    header('Location: login.php');
} 
else 
{
    $user->sessionUnset();

    $_SESSION['current_user'] = $user->login;

    header('Location: index.php');
}