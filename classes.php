<?php

class User {
    public string $login;    
    public string $pwdhash; 
    public string $email; 
    public string $name; 
}

class UserNew {
    public string $login;    
    public string $password; 
    public string $password_repeat; 
    public string $email; 
    public string $name; 

    public function getPasswordHash(): string {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }
}

class UserInspector {
    private UserNew $user;    

    private $messages = [];


    public function __construct(UserNew $user)
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

    private function setBrokenRule(string $msg): void {
        $this->messages[] = $msg;
    }

    public function checkRules() {
        if (empty($this->user->login)) {
            $this->setBrokenRule('Не указано название учётной записи (login)');
        }

        if (empty($this->user->password)) {
            $this->setBrokenRule('Не указан пароль');
        }

        if ($this->user->password !== $this->user->password_repeat) {
            $this->setBrokenRule('Пароль и его повтор не совпадают');
        }

        if (empty($this->user->name)) {
            $this->setBrokenRule('Не указано имя пользователя');
        }
    }
}
