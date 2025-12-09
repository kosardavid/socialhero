<?php
/**
 * Database Setup Script
 * Run once to create tables
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "<h1>SocialHero Database Setup</h1>";

// Database credentials
$host = 'md395.wedos.net';
$dbname = 'd387379_kosar';
$username = 'a387379_kosar';
$password = '4x9JJ8ma';

try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    echo "<p style='color:green;'>✓ Database connection successful!</p>";

    // Check if users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color:blue;'>ℹ Tables already exist. Checking admin user...</p>";

        // Check admin user
        $stmt = $pdo->query("SELECT id, email FROM users WHERE email = 'admin@socialhero.cz'");
        $user = $stmt->fetch();

        if ($user) {
            echo "<p style='color:green;'>✓ Admin user exists: {$user['email']}</p>";

            // Reset password to admin123
            $newPassword = password_hash('admin123', PASSWORD_DEFAULT);
            $pdo->prepare("UPDATE users SET password = ? WHERE email = 'admin@socialhero.cz'")->execute([$newPassword]);
            echo "<p style='color:green;'>✓ Password reset to: admin123</p>";
        } else {
            // Create admin user
            $passwordHash = password_hash('admin123', PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)")
                ->execute(['Admin', 'admin@socialhero.cz', $passwordHash, 'admin']);
            echo "<p style='color:green;'>✓ Admin user created!</p>";
        }
    } else {
        echo "<p style='color:orange;'>⚠ Tables do not exist. Creating...</p>";

        // Create tables
        $sql = "
        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(100) NOT NULL,
            `email` VARCHAR(255) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `role` ENUM('admin', 'editor') NOT NULL DEFAULT 'editor',
            `avatar` VARCHAR(255) DEFAULT NULL,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `last_login` DATETIME DEFAULT NULL,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            INDEX `idx_email` (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `contacts` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `phone` VARCHAR(50) DEFAULT NULL,
            `company` VARCHAR(255) DEFAULT NULL,
            `service` VARCHAR(100) DEFAULT NULL,
            `budget` VARCHAR(100) DEFAULT NULL,
            `message` TEXT NOT NULL,
            `ip_address` VARCHAR(45) DEFAULT NULL,
            `user_agent` VARCHAR(500) DEFAULT NULL,
            `is_read` TINYINT(1) NOT NULL DEFAULT 0,
            `is_archived` TINYINT(1) NOT NULL DEFAULT 0,
            `notes` TEXT DEFAULT NULL,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `email` VARCHAR(255) NOT NULL UNIQUE,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `unsubscribed_at` DATETIME DEFAULT NULL,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `settings` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `key` VARCHAR(100) NOT NULL UNIQUE,
            `value` TEXT DEFAULT NULL,
            `type` ENUM('string', 'text', 'number', 'boolean', 'json') NOT NULL DEFAULT 'string',
            `group` VARCHAR(50) DEFAULT 'general',
            `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";

        $pdo->exec($sql);
        echo "<p style='color:green;'>✓ Tables created!</p>";

        // Create admin user
        $passwordHash = password_hash('admin123', PASSWORD_DEFAULT);
        $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)")
            ->execute(['Admin', 'admin@socialhero.cz', $passwordHash, 'admin']);
        echo "<p style='color:green;'>✓ Admin user created!</p>";
    }

    echo "<hr>";
    echo "<h2>Login Credentials:</h2>";
    echo "<p><strong>URL:</strong> <a href='/new/admin/'>/new/admin/</a></p>";
    echo "<p><strong>Email:</strong> admin@socialhero.cz</p>";
    echo "<p><strong>Password:</strong> admin123</p>";
    echo "<hr>";
    echo "<p style='color:red;'><strong>⚠ DELETE THIS FILE AFTER USE!</strong></p>";

} catch (PDOException $e) {
    echo "<p style='color:red;'>✗ Error: " . $e->getMessage() . "</p>";
}
