<?php
namespace Admin\Controllers;

use App\Core\Database;

class DashboardController
{
    public function index(): void
    {
        // Get statistics
        try {
            $stats = [
                // Primary stats
                'contacts' => Database::fetch("SELECT COUNT(*) as count FROM contacts")['count'] ?? 0,
                'unread_contacts' => Database::fetch("SELECT COUNT(*) as count FROM contacts WHERE is_read = 0")['count'] ?? 0,
                'subscribers' => Database::fetch("SELECT COUNT(*) as count FROM newsletter_subscribers WHERE is_active = 1")['count'] ?? 0,
                'case_studies' => Database::fetch("SELECT COUNT(*) as count FROM case_studies WHERE is_published = 1")['count'] ?? 0,
                // Content stats
                'services' => Database::fetch("SELECT COUNT(*) as count FROM services")['count'] ?? 0,
                'pricing_plans' => Database::fetch("SELECT COUNT(*) as count FROM pricing_plans")['count'] ?? 0,
                'faqs' => Database::fetch("SELECT COUNT(*) as count FROM faqs")['count'] ?? 0,
                'testimonials' => Database::fetch("SELECT COUNT(*) as count FROM testimonials")['count'] ?? 0,
                'team_members' => Database::fetch("SELECT COUNT(*) as count FROM team_members")['count'] ?? 0,
                'blog_posts' => Database::fetch("SELECT COUNT(*) as count FROM blog_posts")['count'] ?? 0,
                'clients' => Database::fetch("SELECT COUNT(*) as count FROM clients")['count'] ?? 0,
            ];

            // Get recent contacts
            $recentContacts = Database::fetchAll(
                "SELECT * FROM contacts ORDER BY created_at DESC LIMIT 5"
            );

            // Get recent subscribers
            $recentSubscribers = Database::fetchAll(
                "SELECT * FROM newsletter_subscribers ORDER BY created_at DESC LIMIT 5"
            );
        } catch (\Exception $e) {
            $stats = [
                'contacts' => 0,
                'unread_contacts' => 0,
                'subscribers' => 0,
                'case_studies' => 0,
                'services' => 0,
                'pricing_plans' => 0,
                'faqs' => 0,
                'testimonials' => 0,
                'team_members' => 0,
                'blog_posts' => 0,
                'clients' => 0,
            ];
            $recentContacts = [];
            $recentSubscribers = [];
            $dbError = 'Databáze není nastavena. Spusťte SQL skript pro vytvoření tabulek.';
        }

        require ADMIN_PATH . '/Views/dashboard.php';
    }
}
