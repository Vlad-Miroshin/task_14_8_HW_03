<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'storage.php';

class User {
    public string $login;    
    public string $password; 
    public string $password_repeat; 
    public string $password_hash; 
    public string $email; 
    public string $name; 
    public string $birthday;
    public int $loginTime;

    public function getPasswordHash(): string {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->password_hash);
    }

    public function sessionSave() {
        $_SESSION['value_user_login'] = $this->login ?? '';
        $_SESSION['value_user_password'] = $this->password ?? '';
        $_SESSION['value_user_password_repeat'] = $this->password_repeat ?? '';
        $_SESSION['value_user_name'] = $this->name ?? '';
        $_SESSION['value_user_email'] = $this->email ?? '';
        $_SESSION['value_user_birthday'] = $this->birthday ?? '';
    }

    public function sessionLoad() {
        $this->login = $_SESSION['value_user_login'] ?? '';
        $this->password = $_SESSION['value_user_password'] ?? '';
        $this->password_repeat = $_SESSION['value_user_password_repeat'] ?? '';
        $this->name = $_SESSION['value_user_name'] ?? '';
        $this->email = $_SESSION['value_user_email'] ?? '';
        $this->birthday = $_SESSION['value_user_birthday'] ?? '';
    }

    public function sessionUnset() {
        unset($_SESSION['value_user_login']);
        unset($_SESSION['value_user_password']);
        unset($_SESSION['value_user_password_repeat']);
        unset($_SESSION['value_user_name']);
        unset($_SESSION['value_user_email']);
        unset($_SESSION['value_user_birthday']);
    }
}

class BaseInspector {
    protected User $user;    
    private $messages = [];

    public function __construct(User $user)
    {
        $this->user = $user;
    }    

    public function hasBrokenRules(): bool {
        return isset($this->messages) && count($this->messages) > 0;
    }

    public function getBrokenRulesAsString(?string $separator = PHP_EOL): string {
        if ($this->hasBrokenRules())
            return implode($separator, $this->messages);
        else
            return '';
    }

    protected function setBrokenRule(string $msg): void {
        $this->messages[] = $msg;
    }
}

class RegisterInspector extends BaseInspector {

    public function checkRules() {
        if (empty($this->user->login)) {
            $this->setBrokenRule('Укажите название учётной записи (login)');
        }

        if (existsUser($this->user->login)) {
            $this->setBrokenRule("Пользователь '{$this->user->login}' уже зарегистрирован");
            return; // дальше не проверяем
        }

        if (empty($this->user->password)) {
            $this->setBrokenRule('Укажите пароль');
        }

        if ($this->user->password !== $this->user->password_repeat) {
            $this->setBrokenRule('Пароль и его повтор не совпадают');
        }

        if (empty($this->user->name)) {
            $this->setBrokenRule('Укажите имя пользователя');
        }

    }
}

class LoginInspector extends BaseInspector {

    public function checkRules() {
        if (empty($this->user->login)) {
            $this->setBrokenRule('Укажите учётную запись (login)');
        }

        if (!existsUser($this->user->login)) {
            $this->setBrokenRule("Пользователь '{$this->user->login}' не зарегистрирован");
        }

        if (empty($this->user->password)) {
            $this->setBrokenRule('Укажите пароль');
        }

        if (!checkPassword($this->user->login, $this->user->password)) {
            $this->setBrokenRule('Пароль неверен');
        }
    }
}

class Product {
    public string $id;
    public string $image;
    public string $title;
    public string $description_short;
}
