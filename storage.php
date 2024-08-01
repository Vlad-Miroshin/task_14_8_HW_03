<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'classes.php';

function getConfig() {
    $config = include __DIR__.DIRECTORY_SEPARATOR.'config.php';
    return $config;
}

function getUsersList(): array {
    $config = getConfig();

    $all_users = [];

    if (($handle = fopen($config['file_path_users'], "r")) !== FALSE) {

        while (($data = fgetcsv($handle)) !== FALSE) {
            $user = new User();
            $user->login = trim($data[0]);
            $user->pwdhash = trim($data[1]);
            $user->email = trim($data[2]);
            $user->name = trim($data[3]);

            $all_users[] = $user;
        }
    
        fclose($handle);
    }    

    return $all_users;
}

function addUser(UserNew $user): void {
    $config = getConfig();

    if (($handle = fopen($config['file_path_users'], "a")) !== FALSE) {

        fputcsv($handle, [
            $user->login, 
            $user->getPasswordHash(), 
            $user->email, 
            $user->name, 
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
