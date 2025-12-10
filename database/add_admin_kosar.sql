-- Add new admin user: kosar.david@gmail.com
-- Password: admin123 (CHANGE THIS AFTER FIRST LOGIN!)
-- Hash generated with password_hash('admin123', PASSWORD_DEFAULT)

INSERT INTO `users` (`name`, `email`, `password`, `role`, `is_active`) VALUES
('David Kosař', 'kosar.david@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1);
