<?php
namespace Admin\Controllers;

use App\Core\Database;

class AuthController
{
    private const MAX_LOGIN_ATTEMPTS = 5;
    private const LOCKOUT_TIME = 900; // 15 minutes in seconds

    public function showLogin(): void
    {
        require ADMIN_PATH . '/Views/login.php';
    }

    public function login(): void
    {
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

        // Check rate limiting
        if ($this->isLockedOut($ip)) {
            $error = 'Příliš mnoho pokusů o přihlášení. Zkuste to za 15 minut.';
            require ADMIN_PATH . '/Views/login.php';
            return;
        }

        if (empty($email) || empty($password)) {
            $error = 'Vyplňte prosím e-mail a heslo.';
            require ADMIN_PATH . '/Views/login.php';
            return;
        }

        try {
            $user = Database::fetch(
                "SELECT * FROM users WHERE email = ? AND is_active = 1",
                [$email]
            );

            if ($user && password_verify($password, $user['password'])) {
                // Clear failed attempts on successful login
                $this->clearFailedAttempts($ip);

                // Update last login
                Database::update('users', [
                    'last_login' => date('Y-m-d H:i:s')
                ], 'id = ?', [$user['id']]);

                // Set session
                $_SESSION['admin_user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                ];

                header('Location: /admin/dashboard');
                exit;
            } else {
                // Record failed attempt
                $this->recordFailedAttempt($ip);

                $error = 'Nesprávný e-mail nebo heslo.';
                require ADMIN_PATH . '/Views/login.php';
            }
        } catch (\Exception $e) {
            $error = 'Chyba při přihlášení. Zkuste to prosím později.';
            require ADMIN_PATH . '/Views/login.php';
        }
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /admin/login');
        exit;
    }

    /**
     * Check if IP is locked out due to too many failed attempts
     */
    private function isLockedOut(string $ip): bool
    {
        $key = 'login_attempts_' . md5($ip);
        $attempts = $_SESSION[$key] ?? ['count' => 0, 'first_attempt' => 0];

        // Reset if lockout time passed
        if ($attempts['first_attempt'] > 0 &&
            (time() - $attempts['first_attempt']) > self::LOCKOUT_TIME) {
            unset($_SESSION[$key]);
            return false;
        }

        return $attempts['count'] >= self::MAX_LOGIN_ATTEMPTS;
    }

    /**
     * Record a failed login attempt
     */
    private function recordFailedAttempt(string $ip): void
    {
        $key = 'login_attempts_' . md5($ip);
        $attempts = $_SESSION[$key] ?? ['count' => 0, 'first_attempt' => time()];

        $attempts['count']++;
        $_SESSION[$key] = $attempts;
    }

    /**
     * Clear failed attempts after successful login
     */
    private function clearFailedAttempts(string $ip): void
    {
        $key = 'login_attempts_' . md5($ip);
        unset($_SESSION[$key]);
    }
}
