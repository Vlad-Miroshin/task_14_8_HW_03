<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'classes.php';

function getConfig() {
    $config = include __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
    return $config;
}

function getUsersList(): array {
    $config = getConfig();

    $all_users = [];

    if (($handle = fopen($config['file_path_users'], "r")) !== FALSE) {

        while (($data = fgetcsv($handle)) !== FALSE) {
            $user = new User();
            $user->login = trim($data[0]);
            $user->password_hash = trim($data[1]);
            $user->email = trim($data[2]);
            $user->name = trim($data[3]);
            $user->birthday = $data[4];

            $all_users[] = $user;
        }
    
        fclose($handle);
    }    

    return $all_users;
}

function addUser(User $user): void {
    $config = getConfig();

    if (($handle = fopen($config['file_path_users'], "a")) !== false) {

        fputcsv($handle, [
            $user->login, 
            $user->getPasswordHash(), 
            $user->email, 
            $user->name, 
            $user->birthday
        ]);

        fclose($handle);
    }    

    return;
}

function getUser(string $login): User|null {
    $all_users = getUsersList();

    foreach ($all_users as $user) {
        if ($user->login === $login) {
            return $user;
        }
    }

    return null;
}

function existsUser(string $login): bool {
    return getUser($login) !== null;
}

function checkPassword(string $login, string $password): bool {
    $user = getUser($login);

    if (isset($user))
        return $user->verifyPassword($password);
    else
        return false;
}

function getProductsList(): array {
    $config = getConfig();

    $all_products = [];

    $data = json_decode(file_get_contents($config['file_path_data']), true);

    foreach ($data['products'] as $prod_data) {
        $prod = new Product();
        $prod->id = $prod_data['id'];
        $prod->image = $prod_data['image'];
        $prod->title = $prod_data['title'];
        $prod->description_short = $prod_data['description_short'];

        $all_products[] = $prod;
    }

    return $all_products;
}

function getProd($id, $collection): Product|null {
    foreach ($collection as $prod) {
        if ($prod->id === $id) {
            return $prod;
        }
    }

    return null;
}

function getCurrentUser(): User|null {
    $login = $_SESSION['current_user_login'] ?? '';

    if (!empty($login)) {
        $user =  getUser($login);
        $user->loginTime = $_SESSION['current_user_login_time'];

        return $user;
    } else {
        return null;
    }
}

function setCurrentUser(User $user) {
    $user->loginTime = time();

    $_SESSION['current_user_login'] = $user->login;
    $_SESSION['current_user_login_time'] = $user->loginTime;
}

function resetCurrentUser() {
    unset($_SESSION['current_user_login']);
    unset($_SESSION['current_user_login_time']);
}
