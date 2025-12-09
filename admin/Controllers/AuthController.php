<?php
namespace Admin\Controllers;

use App\Core\Database;

class AuthController
{
    public function showLogin(): void
    {
        require ADMIN_PATH . '/Views/login.php';
    }

    public function login(): void
    {
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';

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

                header('Location: /new/admin/dashboard');
                exit;
            } else {
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
        header('Location: /new/admin/login');
        exit;
    }
}
