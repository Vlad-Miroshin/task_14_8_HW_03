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

class Congratulation {
    public string $id;
    public string $text;
}

class DiscountForLogin {
    private int $DURATION_HOURS = 24;

    private int $loginTime;
    private bool $is_active;
    private int $remain_hours;
    private int $remain_minutes;
    private int $remain_seconds;

    public function __construct(int $loginTime)
    {
        $this->loginTime = $loginTime;

        $this->calc();
    }

    private function calc(): void {
        $target = $this->loginTime + $this->DURATION_HOURS * 60 * 60;
        $now = time();

        $this->is_active = $now < $target;
        
        if ($this->is_active) {
            $diff = $this->seconds2times($target - $now - 1);
            $this->remain_hours = $diff[2];
            $this->remain_minutes = $diff[1];
            $this->remain_seconds = $diff[0];
        }
    }

    public function isActive(): bool {
        return $this->is_active;
    }

    public function durationHours(): int {
        return $this->DURATION_HOURS;
    }

    public function remainHours(): int {
        return $this->remain_hours;
    }

    public function remainMinutes(): int {
        return $this->remain_minutes;
    }

    public function remainSeconds(): int {
        return $this->remain_seconds;
    }

    private function seconds2times($seconds): array
    {
        $times = array();

        // считать нули в значениях
        $count_zero = false;
        
        // количество секунд в году не учитывает високосный год
        // поэтому функция считает что в году 365 дней
        // секунд в минуте|часе|сутках|году
        $periods = array(60, 3600, 86400, 31536000);
        
        for ($i = 3; $i >= 0; $i--)
        {
            $period = floor($seconds/$periods[$i]);
            if (($period > 0) || ($period == 0 && $count_zero))
            {
                $times[$i+1] = $period;
                $seconds -= ($period * $periods[$i]);
                
                $count_zero = true;
            }
        }
        
        $times[0] = $seconds;
        return $times;
    }    
}

class DiscountForBirthday {
    private int $DURATION_DAYS = 7; // столько дней со дня рождения предоставляется скидка

    private string $birthday;
    private bool $is_active = false;
    private int $days_before_birthday = -1;
    private int $days_after_birthday = -1;

    public function __construct(string $birthday)
    {
        $this->birthday = $birthday ?? '';
        $this->calc();
    }

    private function calc(): void {

        if (empty($this->birthday)) {
            $this->is_active = false;
            $this->days_before_birthday = -1;
            return;
        }

        $birthTime = strtotime($this->birthday);
        $parts = getdate($birthTime);
        $currentBirthTime = mktime(0, 0, 0, $parts['mon'], $parts['mday'], date('Y'));
        $now = time();

        if ($now < $currentBirthTime) {
            $this->days_before_birthday = $this->daysBetween($now, $currentBirthTime);
        }

        if ($currentBirthTime <= $now) {
            $this->days_after_birthday = $this->daysBetween($currentBirthTime, $now);
            $this->is_active = $this->days_after_birthday <= $this->DURATION_DAYS;
        }
    }

    public function durationDays(): int {
        return $this->DURATION_DAYS;
    }

    public function isActive(): bool {
        return $this->is_active;
    }

    public function daysBeforeBirthday(): int {
        return $this->days_before_birthday;
    }

    private function getTitle(int $n, array $titles): string {
        $cases = array(2, 0, 1, 1, 1, 2);
        return $titles[($n % 100 > 4 && $n % 100 < 20) ? 2 : $cases[min($n % 10, 5)]];
    }

    public function daysBeforeAsString(): string {
        return $this->days_before_birthday . ' ' . $this->getTitle($this->days_before_birthday, ['день', 'дня', 'дней']);
    }

    private function daysBetween(int $time_1, int $time_2)
    {
        $seconds = $time_2 - $time_1;
        return floor($seconds / 86400);
    }

}
