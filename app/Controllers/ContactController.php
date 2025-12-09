<?php
namespace App\Controllers;

use App\Core\View;
use App\Core\Database;

class ContactController
{
    public function submit(): void
    {
        header('Content-Type: application/json');

        // Validate CSRF
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            echo json_encode(['success' => false, 'message' => 'Neplatný bezpečnostní token.']);
            return;
        }

        // Validate required fields
        $required = ['name', 'email', 'message'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                echo json_encode(['success' => false, 'message' => 'Vyplňte prosím všechna povinná pole.']);
                return;
            }
        }

        // Sanitize input
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $phone = filter_var($_POST['phone'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $company = filter_var($_POST['company'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $service = filter_var($_POST['service'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $budget = filter_var($_POST['budget'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Zadejte prosím platnou e-mailovou adresu.']);
            return;
        }

        // Save to database
        try {
            Database::insert('contacts', [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'company' => $company,
                'service' => $service,
                'budget' => $budget,
                'message' => $message,
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            // Send notification email
            $this->sendNotificationEmail($name, $email, $phone, $company, $service, $budget, $message);

            echo json_encode([
                'success' => true,
                'message' => 'Děkujeme za vaši zprávu! Ozveme se vám co nejdříve.'
            ]);
        } catch (\Exception $e) {
            error_log('Contact form error: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Omlouváme se, došlo k chybě. Zkuste to prosím později.'
            ]);
        }
    }

    private function sendNotificationEmail(
        string $name,
        string $email,
        string $phone,
        string $company,
        string $service,
        string $budget,
        string $message
    ): void {
        $config = require BASE_PATH . '/config/app.php';

        $to = $config['contact']['email'];
        $subject = "Nová poptávka z webu - {$name}";

        $body = "Nová poptávka z kontaktního formuláře:\n\n";
        $body .= "Jméno: {$name}\n";
        $body .= "E-mail: {$email}\n";
        $body .= "Telefon: {$phone}\n";
        $body .= "Firma: {$company}\n";
        $body .= "Služba: {$service}\n";
        $body .= "Rozpočet: {$budget}\n";
        $body .= "Zpráva:\n{$message}\n\n";
        $body .= "---\n";
        $body .= "Odesláno: " . date('d.m.Y H:i:s') . "\n";
        $body .= "IP: " . $_SERVER['REMOTE_ADDR'];

        $headers = [
            'From' => "noreply@socialhero.cz",
            'Reply-To' => $email,
            'Content-Type' => 'text/plain; charset=UTF-8',
        ];

        $headerString = '';
        foreach ($headers as $key => $value) {
            $headerString .= "{$key}: {$value}\r\n";
        }

        mail($to, $subject, $body, $headerString);
    }

    public function newsletter(): void
    {
        header('Content-Type: application/json');

        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Zadejte prosím platnou e-mailovou adresu.']);
            return;
        }

        try {
            // Check if already subscribed
            $existing = Database::fetch(
                "SELECT id FROM newsletter_subscribers WHERE email = ?",
                [$email]
            );

            if ($existing) {
                echo json_encode(['success' => true, 'message' => 'Tento e-mail je již přihlášen k odběru.']);
                return;
            }

            Database::insert('newsletter_subscribers', [
                'email' => $email,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            echo json_encode([
                'success' => true,
                'message' => 'Úspěšně jste se přihlásili k odběru novinek!'
            ]);
        } catch (\Exception $e) {
            error_log('Newsletter subscription error: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Omlouváme se, došlo k chybě. Zkuste to prosím později.'
            ]);
        }
    }
}
