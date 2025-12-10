<?php
namespace Admin\Controllers;

use App\Core\Database;

class ContentController
{
    private string $basePath = '/admin';

    // ==================== CONTACTS ====================
    public function contacts(): void
    {
        try {
            $contacts = Database::fetchAll(
                "SELECT * FROM contacts ORDER BY created_at DESC"
            );
        } catch (\Exception $e) {
            $contacts = [];
        }
        require ADMIN_PATH . '/Views/contacts.php';
    }

    public function contactDetail(int $id): void
    {
        try {
            $contact = Database::fetch("SELECT * FROM contacts WHERE id = ?", [$id]);
            if (!$contact) {
                header('Location: ' . $this->basePath . '/contacts');
                exit;
            }
            if (!$contact['is_read']) {
                Database::update('contacts', ['is_read' => 1], 'id = ?', [$id]);
            }
        } catch (\Exception $e) {
            header('Location: ' . $this->basePath . '/contacts');
            exit;
        }
        require ADMIN_PATH . '/Views/contact-detail.php';
    }

    public function markContactRead(int $id): void
    {
        try {
            Database::update('contacts', ['is_read' => 1], 'id = ?', [$id]);
        } catch (\Exception $e) {}
        header('Location: ' . $this->basePath . '/contacts');
        exit;
    }

    // ==================== SERVICES ====================
    public function services(): void
    {
        try {
            $services = Database::fetchAll("SELECT * FROM services ORDER BY sort_order ASC");
        } catch (\Exception $e) {
            $services = [];
        }
        require ADMIN_PATH . '/Views/services.php';
    }

    public function serviceForm(?int $id = null): void
    {
        $service = null;
        $errors = [];

        if ($id) {
            try {
                $service = Database::fetch("SELECT * FROM services WHERE id = ?", [$id]);
            } catch (\Exception $e) {}
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateService($_POST);

            if (empty($data['errors'])) {
                try {
                    if ($id) {
                        Database::update('services', $data['data'], 'id = ?', [$id]);
                        $_SESSION['flash_success'] = 'Služba byla aktualizována.';
                    } else {
                        Database::insert('services', $data['data']);
                        $_SESSION['flash_success'] = 'Služba byla vytvořena.';
                    }
                    header('Location: ' . $this->basePath . '/services');
                    exit;
                } catch (\Exception $e) {
                    $errors[] = 'Chyba při ukládání: ' . $e->getMessage();
                }
            } else {
                $errors = $data['errors'];
            }
        }

        require ADMIN_PATH . '/Views/service-form.php';
    }

    public function serviceDelete(int $id): void
    {
        try {
            Database::delete('services', 'id = ?', [$id]);
            $_SESSION['flash_success'] = 'Služba byla smazána.';
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = 'Chyba při mazání.';
        }
        header('Location: ' . $this->basePath . '/services');
        exit;
    }

    private function validateService(array $post): array
    {
        $errors = [];
        $data = [];

        $data['title'] = trim($post['title'] ?? '');
        $data['slug'] = trim($post['slug'] ?? '') ?: $this->slugify($data['title']);
        $data['short_description'] = trim($post['short_description'] ?? '');
        $data['description'] = trim($post['description'] ?? '');
        $data['icon'] = trim($post['icon'] ?? 'box');
        $data['features'] = json_encode(array_filter(array_map('trim', explode("\n", $post['features'] ?? ''))));
        $data['meta_title'] = trim($post['meta_title'] ?? '');
        $data['meta_description'] = trim($post['meta_description'] ?? '');
        $data['sort_order'] = (int)($post['sort_order'] ?? 0);
        $data['is_active'] = isset($post['is_active']) ? 1 : 0;

        if (empty($data['title'])) $errors[] = 'Název je povinný.';

        return ['data' => $data, 'errors' => $errors];
    }

    // ==================== PRICING ====================
    public function pricing(): void
    {
        try {
            $plans = Database::fetchAll("SELECT * FROM pricing_plans ORDER BY sort_order ASC");
        } catch (\Exception $e) {
            $plans = [];
        }
        require ADMIN_PATH . '/Views/pricing.php';
    }

    public function pricingForm(?int $id = null): void
    {
        $plan = null;
        $errors = [];

        if ($id) {
            try {
                $plan = Database::fetch("SELECT * FROM pricing_plans WHERE id = ?", [$id]);
            } catch (\Exception $e) {}
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validatePricing($_POST);

            if (empty($data['errors'])) {
                try {
                    if ($id) {
                        Database::update('pricing_plans', $data['data'], 'id = ?', [$id]);
                        $_SESSION['flash_success'] = 'Ceník byl aktualizován.';
                    } else {
                        Database::insert('pricing_plans', $data['data']);
                        $_SESSION['flash_success'] = 'Ceník byl vytvořen.';
                    }
                    header('Location: ' . $this->basePath . '/pricing');
                    exit;
                } catch (\Exception $e) {
                    $errors[] = 'Chyba při ukládání: ' . $e->getMessage();
                }
            } else {
                $errors = $data['errors'];
            }
        }

        require ADMIN_PATH . '/Views/pricing-form.php';
    }

    public function pricingDelete(int $id): void
    {
        try {
            Database::delete('pricing_plans', 'id = ?', [$id]);
            $_SESSION['flash_success'] = 'Cenový plán byl smazán.';
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = 'Chyba při mazání.';
        }
        header('Location: ' . $this->basePath . '/pricing');
        exit;
    }

    private function validatePricing(array $post): array
    {
        $errors = [];
        $data = [];

        $data['name'] = trim($post['name'] ?? '');
        $data['slug'] = trim($post['slug'] ?? '') ?: $this->slugify($data['name']);
        $data['price'] = (float)($post['price'] ?? 0);
        $data['currency'] = 'CZK';
        $data['period'] = trim($post['period'] ?? 'měsíčně');
        $data['hours'] = trim($post['hours'] ?? '');
        $data['description'] = trim($post['description'] ?? '');
        $data['features'] = json_encode(array_filter(array_map('trim', explode("\n", $post['features'] ?? ''))));
        $data['is_featured'] = isset($post['is_featured']) ? 1 : 0;
        $data['is_active'] = isset($post['is_active']) ? 1 : 0;
        $data['sort_order'] = (int)($post['sort_order'] ?? 0);

        if (empty($data['name'])) $errors[] = 'Název je povinný.';
        if ($data['price'] <= 0) $errors[] = 'Cena musí být větší než 0.';

        return ['data' => $data, 'errors' => $errors];
    }

    // ==================== FAQS ====================
    public function faqs(): void
    {
        try {
            $faqs = Database::fetchAll("SELECT * FROM faqs ORDER BY sort_order ASC");
        } catch (\Exception $e) {
            $faqs = [];
        }
        require ADMIN_PATH . '/Views/faqs.php';
    }

    public function faqForm(?int $id = null): void
    {
        $faq = null;
        $errors = [];

        if ($id) {
            try {
                $faq = Database::fetch("SELECT * FROM faqs WHERE id = ?", [$id]);
            } catch (\Exception $e) {}
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateFaq($_POST);

            if (empty($data['errors'])) {
                try {
                    if ($id) {
                        Database::update('faqs', $data['data'], 'id = ?', [$id]);
                        $_SESSION['flash_success'] = 'FAQ bylo aktualizováno.';
                    } else {
                        Database::insert('faqs', $data['data']);
                        $_SESSION['flash_success'] = 'FAQ bylo vytvořeno.';
                    }
                    header('Location: ' . $this->basePath . '/faqs');
                    exit;
                } catch (\Exception $e) {
                    $errors[] = 'Chyba při ukládání: ' . $e->getMessage();
                }
            } else {
                $errors = $data['errors'];
            }
        }

        require ADMIN_PATH . '/Views/faq-form.php';
    }

    public function faqDelete(int $id): void
    {
        try {
            Database::delete('faqs', 'id = ?', [$id]);
            $_SESSION['flash_success'] = 'FAQ bylo smazáno.';
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = 'Chyba při mazání.';
        }
        header('Location: ' . $this->basePath . '/faqs');
        exit;
    }

    private function validateFaq(array $post): array
    {
        $errors = [];
        $data = [];

        $data['question'] = trim($post['question'] ?? '');
        $data['answer'] = trim($post['answer'] ?? '');
        $data['category'] = trim($post['category'] ?? '');
        $data['sort_order'] = (int)($post['sort_order'] ?? 0);
        $data['is_active'] = isset($post['is_active']) ? 1 : 0;

        if (empty($data['question'])) $errors[] = 'Otázka je povinná.';
        if (empty($data['answer'])) $errors[] = 'Odpověď je povinná.';

        return ['data' => $data, 'errors' => $errors];
    }

    // ==================== TESTIMONIALS ====================
    public function testimonials(): void
    {
        try {
            $testimonials = Database::fetchAll("SELECT * FROM testimonials ORDER BY sort_order ASC");
        } catch (\Exception $e) {
            $testimonials = [];
        }
        require ADMIN_PATH . '/Views/testimonials.php';
    }

    public function testimonialForm(?int $id = null): void
    {
        $testimonial = null;
        $errors = [];

        if ($id) {
            try {
                $testimonial = Database::fetch("SELECT * FROM testimonials WHERE id = ?", [$id]);
            } catch (\Exception $e) {}
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateTestimonial($_POST);

            if (empty($data['errors'])) {
                try {
                    if ($id) {
                        Database::update('testimonials', $data['data'], 'id = ?', [$id]);
                        $_SESSION['flash_success'] = 'Testimonial byl aktualizován.';
                    } else {
                        Database::insert('testimonials', $data['data']);
                        $_SESSION['flash_success'] = 'Testimonial byl vytvořen.';
                    }
                    header('Location: ' . $this->basePath . '/testimonials');
                    exit;
                } catch (\Exception $e) {
                    $errors[] = 'Chyba při ukládání: ' . $e->getMessage();
                }
            } else {
                $errors = $data['errors'];
            }
        }

        require ADMIN_PATH . '/Views/testimonial-form.php';
    }

    public function testimonialDelete(int $id): void
    {
        try {
            Database::delete('testimonials', 'id = ?', [$id]);
            $_SESSION['flash_success'] = 'Testimonial byl smazán.';
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = 'Chyba při mazání.';
        }
        header('Location: ' . $this->basePath . '/testimonials');
        exit;
    }

    private function validateTestimonial(array $post): array
    {
        $errors = [];
        $data = [];

        $data['name'] = trim($post['name'] ?? '');
        $data['company'] = trim($post['company'] ?? '');
        $data['position'] = trim($post['position'] ?? '');
        $data['text'] = trim($post['text'] ?? '');
        $data['image'] = trim($post['image'] ?? '');
        $data['rating'] = (int)($post['rating'] ?? 5);
        $data['is_featured'] = isset($post['is_featured']) ? 1 : 0;
        $data['is_active'] = isset($post['is_active']) ? 1 : 0;
        $data['sort_order'] = (int)($post['sort_order'] ?? 0);

        if (empty($data['name'])) $errors[] = 'Jméno je povinné.';
        if (empty($data['text'])) $errors[] = 'Text je povinný.';

        return ['data' => $data, 'errors' => $errors];
    }

    // ==================== CASE STUDIES ====================
    public function caseStudies(): void
    {
        try {
            $caseStudies = Database::fetchAll("SELECT * FROM case_studies ORDER BY sort_order ASC");
        } catch (\Exception $e) {
            $caseStudies = [];
        }
        require ADMIN_PATH . '/Views/case-studies.php';
    }

    public function caseStudyForm(?int $id = null): void
    {
        $caseStudy = null;
        $errors = [];

        if ($id) {
            try {
                $caseStudy = Database::fetch("SELECT * FROM case_studies WHERE id = ?", [$id]);
            } catch (\Exception $e) {}
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateCaseStudy($_POST);

            if (empty($data['errors'])) {
                try {
                    if ($id) {
                        Database::update('case_studies', $data['data'], 'id = ?', [$id]);
                        $_SESSION['flash_success'] = 'Reference byla aktualizována.';
                    } else {
                        Database::insert('case_studies', $data['data']);
                        $_SESSION['flash_success'] = 'Reference byla vytvořena.';
                    }
                    header('Location: ' . $this->basePath . '/case-studies');
                    exit;
                } catch (\Exception $e) {
                    $errors[] = 'Chyba při ukládání: ' . $e->getMessage();
                }
            } else {
                $errors = $data['errors'];
            }
        }

        require ADMIN_PATH . '/Views/case-study-form.php';
    }

    public function caseStudyDelete(int $id): void
    {
        try {
            Database::delete('case_studies', 'id = ?', [$id]);
            $_SESSION['flash_success'] = 'Reference byla smazána.';
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = 'Chyba při mazání.';
        }
        header('Location: ' . $this->basePath . '/case-studies');
        exit;
    }

    private function validateCaseStudy(array $post): array
    {
        $errors = [];
        $data = [];

        $data['title'] = trim($post['title'] ?? '');
        $data['slug'] = trim($post['slug'] ?? '') ?: $this->slugify($data['title']);
        $data['client_name'] = trim($post['client_name'] ?? '');
        $data['category'] = trim($post['category'] ?? '');
        $data['short_description'] = trim($post['short_description'] ?? '');
        $data['description'] = trim($post['description'] ?? '');
        $data['challenge'] = trim($post['challenge'] ?? '');
        $data['solution'] = trim($post['solution'] ?? '');
        $data['results'] = json_encode(array_filter(array_map('trim', explode("\n", $post['results'] ?? ''))));
        $data['image'] = trim($post['image'] ?? '');
        $data['meta_title'] = trim($post['meta_title'] ?? '');
        $data['meta_description'] = trim($post['meta_description'] ?? '');
        $data['is_featured'] = isset($post['is_featured']) ? 1 : 0;
        $data['is_published'] = isset($post['is_published']) ? 1 : 0;
        $data['sort_order'] = (int)($post['sort_order'] ?? 0);

        if (empty($data['title'])) $errors[] = 'Název je povinný.';

        return ['data' => $data, 'errors' => $errors];
    }

    // ==================== TEAM ====================
    public function team(): void
    {
        try {
            $team = Database::fetchAll("SELECT * FROM team_members ORDER BY sort_order ASC");
        } catch (\Exception $e) {
            $team = [];
        }
        require ADMIN_PATH . '/Views/team.php';
    }

    public function teamForm(?int $id = null): void
    {
        $member = null;
        $errors = [];

        if ($id) {
            try {
                $member = Database::fetch("SELECT * FROM team_members WHERE id = ?", [$id]);
            } catch (\Exception $e) {}
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateTeam($_POST);

            if (empty($data['errors'])) {
                try {
                    if ($id) {
                        Database::update('team_members', $data['data'], 'id = ?', [$id]);
                        $_SESSION['flash_success'] = 'Člen týmu byl aktualizován.';
                    } else {
                        Database::insert('team_members', $data['data']);
                        $_SESSION['flash_success'] = 'Člen týmu byl vytvořen.';
                    }
                    header('Location: ' . $this->basePath . '/team');
                    exit;
                } catch (\Exception $e) {
                    $errors[] = 'Chyba při ukládání: ' . $e->getMessage();
                }
            } else {
                $errors = $data['errors'];
            }
        }

        require ADMIN_PATH . '/Views/team-form.php';
    }

    public function teamDelete(int $id): void
    {
        try {
            Database::delete('team_members', 'id = ?', [$id]);
            $_SESSION['flash_success'] = 'Člen týmu byl smazán.';
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = 'Chyba při mazání.';
        }
        header('Location: ' . $this->basePath . '/team');
        exit;
    }

    private function validateTeam(array $post): array
    {
        $errors = [];
        $data = [];

        $data['name'] = trim($post['name'] ?? '');
        $data['position'] = trim($post['position'] ?? '');
        $data['bio'] = trim($post['bio'] ?? '');
        $data['image'] = trim($post['image'] ?? '');
        $data['email'] = trim($post['email'] ?? '');
        $data['linkedin'] = trim($post['linkedin'] ?? '');
        $data['sort_order'] = (int)($post['sort_order'] ?? 0);
        $data['is_active'] = isset($post['is_active']) ? 1 : 0;

        if (empty($data['name'])) $errors[] = 'Jméno je povinné.';

        return ['data' => $data, 'errors' => $errors];
    }

    // ==================== BLOG ====================
    public function blog(): void
    {
        try {
            $posts = Database::fetchAll("SELECT * FROM blog_posts ORDER BY created_at DESC");
        } catch (\Exception $e) {
            $posts = [];
        }
        require ADMIN_PATH . '/Views/blog.php';
    }

    public function blogForm(?int $id = null): void
    {
        $post = null;
        $errors = [];

        if ($id) {
            try {
                $post = Database::fetch("SELECT * FROM blog_posts WHERE id = ?", [$id]);
            } catch (\Exception $e) {}
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateBlog($_POST);

            if (empty($data['errors'])) {
                try {
                    if ($id) {
                        Database::update('blog_posts', $data['data'], 'id = ?', [$id]);
                        $_SESSION['flash_success'] = 'Článek byl aktualizován.';
                    } else {
                        Database::insert('blog_posts', $data['data']);
                        $_SESSION['flash_success'] = 'Článek byl vytvořen.';
                    }
                    header('Location: ' . $this->basePath . '/blog');
                    exit;
                } catch (\Exception $e) {
                    $errors[] = 'Chyba při ukládání: ' . $e->getMessage();
                }
            } else {
                $errors = $data['errors'];
            }
        }

        require ADMIN_PATH . '/Views/blog-form.php';
    }

    public function blogDelete(int $id): void
    {
        try {
            Database::delete('blog_posts', 'id = ?', [$id]);
            $_SESSION['flash_success'] = 'Článek byl smazán.';
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = 'Chyba při mazání.';
        }
        header('Location: ' . $this->basePath . '/blog');
        exit;
    }

    private function validateBlog(array $post): array
    {
        $errors = [];
        $data = [];

        $data['title'] = trim($post['title'] ?? '');
        $data['slug'] = trim($post['slug'] ?? '') ?: $this->slugify($data['title']);
        $data['excerpt'] = trim($post['excerpt'] ?? '');
        $data['content'] = $post['content'] ?? '';
        $data['image'] = trim($post['image'] ?? '');
        $data['category'] = trim($post['category'] ?? '');
        $data['tags'] = json_encode(array_filter(array_map('trim', explode(',', $post['tags'] ?? ''))));
        $data['meta_title'] = trim($post['meta_title'] ?? '');
        $data['meta_description'] = trim($post['meta_description'] ?? '');
        $data['is_featured'] = isset($post['is_featured']) ? 1 : 0;
        $data['is_published'] = isset($post['is_published']) ? 1 : 0;
        if ($data['is_published'] && empty($post['published_at'])) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        if (empty($data['title'])) $errors[] = 'Název je povinný.';

        return ['data' => $data, 'errors' => $errors];
    }

    // ==================== CLIENTS ====================
    public function clients(): void
    {
        try {
            $clients = Database::fetchAll("SELECT * FROM clients ORDER BY sort_order ASC");
        } catch (\Exception $e) {
            $clients = [];
        }
        require ADMIN_PATH . '/Views/clients.php';
    }

    public function clientForm(?int $id = null): void
    {
        $client = null;
        $errors = [];

        if ($id) {
            try {
                $client = Database::fetch("SELECT * FROM clients WHERE id = ?", [$id]);
            } catch (\Exception $e) {}
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateClient($_POST);

            if (empty($data['errors'])) {
                try {
                    if ($id) {
                        Database::update('clients', $data['data'], 'id = ?', [$id]);
                        $_SESSION['flash_success'] = 'Klient byl aktualizován.';
                    } else {
                        Database::insert('clients', $data['data']);
                        $_SESSION['flash_success'] = 'Klient byl vytvořen.';
                    }
                    header('Location: ' . $this->basePath . '/clients');
                    exit;
                } catch (\Exception $e) {
                    $errors[] = 'Chyba při ukládání: ' . $e->getMessage();
                }
            } else {
                $errors = $data['errors'];
            }
        }

        require ADMIN_PATH . '/Views/client-form.php';
    }

    public function clientDelete(int $id): void
    {
        try {
            Database::delete('clients', 'id = ?', [$id]);
            $_SESSION['flash_success'] = 'Klient byl smazán.';
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = 'Chyba při mazání.';
        }
        header('Location: ' . $this->basePath . '/clients');
        exit;
    }

    private function validateClient(array $post): array
    {
        $errors = [];
        $data = [];

        $data['name'] = trim($post['name'] ?? '');
        $data['logo'] = trim($post['logo'] ?? '');
        $data['website'] = trim($post['website'] ?? '');
        $data['sort_order'] = (int)($post['sort_order'] ?? 0);
        $data['is_active'] = isset($post['is_active']) ? 1 : 0;

        if (empty($data['name'])) $errors[] = 'Název je povinný.';

        return ['data' => $data, 'errors' => $errors];
    }

    // ==================== SETTINGS ====================
    public function settings(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->saveSettings();
            return;
        }

        try {
            $settings = Database::fetchAll("SELECT * FROM settings");
            $settingsArray = [];
            foreach ($settings as $setting) {
                $settingsArray[$setting['key']] = $setting['value'];
            }
        } catch (\Exception $e) {
            $settingsArray = [];
        }

        require ADMIN_PATH . '/Views/settings.php';
    }

    private function saveSettings(): void
    {
        try {
            foreach ($_POST as $key => $value) {
                if (strpos($key, '_') === 0) continue;

                $existing = Database::fetch("SELECT id FROM settings WHERE `key` = ?", [$key]);

                if ($existing) {
                    Database::update('settings', ['value' => $value], '`key` = ?', [$key]);
                } else {
                    Database::insert('settings', [
                        'key' => $key,
                        'value' => $value,
                        'type' => 'string',
                        'group' => 'general'
                    ]);
                }
            }
            $_SESSION['flash_success'] = 'Nastavení bylo uloženo.';
        } catch (\Exception $e) {
            $_SESSION['flash_error'] = 'Chyba při ukládání nastavení.';
        }

        header('Location: ' . $this->basePath . '/settings');
        exit;
    }

    public function changePassword(): void
    {
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Get current user
        $userId = $_SESSION['admin_user']['id'] ?? null;
        if (!$userId) {
            header('Location: ' . $this->basePath . '/login');
            exit;
        }

        try {
            $user = Database::fetch("SELECT * FROM users WHERE id = ?", [$userId]);

            if (!$user || !password_verify($currentPassword, $user['password'])) {
                $_SESSION['password_error'] = 'Aktuální heslo není správné.';
                header('Location: ' . $this->basePath . '/settings');
                exit;
            }

            if (strlen($newPassword) < 8) {
                $_SESSION['password_error'] = 'Nové heslo musí mít minimálně 8 znaků.';
                header('Location: ' . $this->basePath . '/settings');
                exit;
            }

            if ($newPassword !== $confirmPassword) {
                $_SESSION['password_error'] = 'Hesla se neshodují.';
                header('Location: ' . $this->basePath . '/settings');
                exit;
            }

            // Update password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            Database::update('users', ['password' => $hashedPassword], 'id = ?', [$userId]);

            $_SESSION['password_success'] = 'Heslo bylo úspěšně změněno.';

        } catch (\Exception $e) {
            $_SESSION['password_error'] = 'Chyba při změně hesla.';
        }

        header('Location: ' . $this->basePath . '/settings');
        exit;
    }

    // ==================== PROCESS STEPS ====================
    public function processSteps(): void
    {
        try {
            $items = Database::fetchAll("SELECT * FROM process_steps ORDER BY sort_order ASC");
        } catch (\Exception $e) {
            $items = [];
        }
        require ADMIN_PATH . '/Views/process-steps.php';
    }

    public function processStepForm(?int $id = null): void
    {
        $item = null;
        $errors = [];

        if ($id) {
            try {
                $item = Database::fetch("SELECT * FROM process_steps WHERE id = ?", [$id]);
            } catch (\Exception $e) {}
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'icon' => trim($_POST['icon'] ?? 'check'),
                'sort_order' => (int)($_POST['sort_order'] ?? 0),
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];

            if (empty($data['title'])) {
                $errors[] = 'Název je povinný.';
            }

            if (empty($errors)) {
                try {
                    if ($id) {
                        Database::update('process_steps', $data, 'id = ?', [$id]);
                        $_SESSION['flash_message'] = 'Krok byl aktualizován.';
                    } else {
                        Database::insert('process_steps', $data);
                        $_SESSION['flash_message'] = 'Krok byl vytvořen.';
                    }
                    header('Location: ' . $this->basePath . '/process-steps');
                    exit;
                } catch (\Exception $e) {
                    $errors[] = 'Chyba při ukládání: ' . $e->getMessage();
                }
            }
        }

        require ADMIN_PATH . '/Views/process-step-form.php';
    }

    public function processStepDelete(int $id): void
    {
        try {
            Database::delete('process_steps', 'id = ?', [$id]);
            $_SESSION['flash_message'] = 'Krok byl smazán.';
        } catch (\Exception $e) {
            $_SESSION['flash_message'] = 'Chyba při mazání.';
            $_SESSION['flash_type'] = 'error';
        }
        header('Location: ' . $this->basePath . '/process-steps');
        exit;
    }

    // ==================== CERTIFICATIONS ====================
    public function certifications(): void
    {
        try {
            $items = Database::fetchAll("SELECT * FROM certifications ORDER BY sort_order ASC");
        } catch (\Exception $e) {
            $items = [];
        }
        require ADMIN_PATH . '/Views/certifications.php';
    }

    public function certificationForm(?int $id = null): void
    {
        $item = null;
        $errors = [];

        if ($id) {
            try {
                $item = Database::fetch("SELECT * FROM certifications WHERE id = ?", [$id]);
            } catch (\Exception $e) {}
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'icon' => trim($_POST['icon'] ?? 'award'),
                'color' => trim($_POST['color'] ?? '#7c3aed'),
                'url' => trim($_POST['url'] ?? ''),
                'sort_order' => (int)($_POST['sort_order'] ?? 0),
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];

            if (empty($data['name'])) {
                $errors[] = 'Název je povinný.';
            }

            if (empty($errors)) {
                try {
                    if ($id) {
                        Database::update('certifications', $data, 'id = ?', [$id]);
                        $_SESSION['flash_message'] = 'Certifikace byla aktualizována.';
                    } else {
                        Database::insert('certifications', $data);
                        $_SESSION['flash_message'] = 'Certifikace byla vytvořena.';
                    }
                    header('Location: ' . $this->basePath . '/certifications');
                    exit;
                } catch (\Exception $e) {
                    $errors[] = 'Chyba při ukládání: ' . $e->getMessage();
                }
            }
        }

        require ADMIN_PATH . '/Views/certification-form.php';
    }

    public function certificationDelete(int $id): void
    {
        try {
            Database::delete('certifications', 'id = ?', [$id]);
            $_SESSION['flash_message'] = 'Certifikace byla smazána.';
        } catch (\Exception $e) {
            $_SESSION['flash_message'] = 'Chyba při mazání.';
            $_SESSION['flash_type'] = 'error';
        }
        header('Location: ' . $this->basePath . '/certifications');
        exit;
    }

    // ==================== PAGE SEO ====================
    public function pageSeo(): void
    {
        // Handle POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pages'])) {
            try {
                foreach ($_POST['pages'] as $pageData) {
                    $id = (int)($pageData['id'] ?? 0);
                    if ($id > 0) {
                        Database::query(
                            "UPDATE page_seo SET meta_title = ?, meta_description = ?, meta_keywords = ? WHERE id = ?",
                            [
                                trim($pageData['meta_title'] ?? ''),
                                trim($pageData['meta_description'] ?? ''),
                                trim($pageData['meta_keywords'] ?? ''),
                                $id
                            ]
                        );
                    }
                }
                $_SESSION['flash_success'] = 'SEO nastavení bylo uloženo.';
            } catch (\Exception $e) {
                $_SESSION['flash_error'] = 'Chyba při ukládání: ' . $e->getMessage();
            }
            header('Location: ' . $this->basePath . '/page-seo');
            exit;
        }

        // Load pages
        try {
            $pages = Database::fetchAll("SELECT * FROM page_seo ORDER BY id ASC");
        } catch (\Exception $e) {
            $pages = [];
        }

        require ADMIN_PATH . '/Views/page-seo.php';
    }

    // ==================== PAGE CONTENT ====================
    public function pageContent(): void
    {
        // Handle POST - save content
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                foreach ($_POST as $key => $value) {
                    // Parse key: page_section_field
                    $parts = explode('_', $key, 3);
                    if (count($parts) !== 3) continue;

                    [$page, $section, $field] = $parts;

                    // Check if exists
                    $existing = Database::fetch(
                        "SELECT id FROM page_content WHERE page = ? AND section = ? AND field = ?",
                        [$page, $section, $field]
                    );

                    if ($existing) {
                        Database::query(
                            "UPDATE page_content SET content = ?, updated_at = NOW() WHERE id = ?",
                            [$value, $existing['id']]
                        );
                    } else {
                        Database::insert('page_content', [
                            'page' => $page,
                            'section' => $section,
                            'field' => $field,
                            'content' => $value
                        ]);
                    }
                }
                $_SESSION['flash_success'] = 'Obsah byl uložen.';
            } catch (\Exception $e) {
                $_SESSION['flash_error'] = 'Chyba při ukládání: ' . $e->getMessage();
            }

            $redirectPage = $_POST['page'] ?? 'home';
            header('Location: ' . $this->basePath . '/page-content?page=' . $redirectPage);
            exit;
        }

        // Load all content
        try {
            $content = Database::fetchAll("SELECT * FROM page_content ORDER BY page, section, field");
        } catch (\Exception $e) {
            $content = [];
        }

        require ADMIN_PATH . '/Views/page-content.php';
    }

    // ==================== HELPERS ====================
    private function slugify(string $text): string
    {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        $text = preg_replace('/[^a-zA-Z0-9\s-]/', '', $text);
        $text = strtolower(trim($text));
        $text = preg_replace('/[\s-]+/', '-', $text);
        return $text;
    }
}
