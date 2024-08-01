<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'boot.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'storage.php';

resetCurrentUser();

session_destroy();

header('Location: index.php');
