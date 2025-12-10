<?php
$pageTitle = 'Obsah stránek';
$currentPage = 'page-content';
ob_start();

// Definice stránek a sekcí pro zobrazení
$pageDefinitions = [
    'home' => [
        'label' => 'Homepage',
        'icon' => 'home',
        'sections' => [
            'hero' => 'Hero sekce',
            'stats' => 'Statistiky (pod hero)',
            'services' => 'Sekce služeb',
            'process' => 'Proces spolupráce',
            'whyus' => 'Proč my',
            'video' => 'Video sekce',
            'certifications' => 'Certifikace',
            'pricing' => 'Ceník (preview)',
            'testimonials' => 'Reference (preview)',
            'faq' => 'FAQ (preview)',
            'cta' => 'CTA sekce'
        ]
    ],
    'about' => [
        'label' => 'O nás',
        'icon' => 'users',
        'sections' => [
            'hero' => 'Hlavička stránky',
            'story' => 'Náš příběh',
            'values' => 'Hodnoty',
            'team' => 'Tým',
            'stats' => 'Statistiky',
            'cta' => 'CTA sekce'
        ]
    ],
    'contact' => [
        'label' => 'Kontakt',
        'icon' => 'mail',
        'sections' => [
            'hero' => 'Hlavička stránky',
            'form' => 'Kontaktní formulář',
            'info' => 'Kontaktní info',
            'social' => 'Sociální sítě'
        ]
    ],
    'services' => [
        'label' => 'Služby',
        'icon' => 'briefcase',
        'sections' => [
            'hero' => 'Hlavička stránky',
            'cta' => 'CTA sekce'
        ]
    ],
    'references' => [
        'label' => 'Reference',
        'icon' => 'star',
        'sections' => [
            'hero' => 'Hlavička stránky',
            'clients' => 'Klienti',
            'cta' => 'CTA sekce'
        ]
    ],
    'pricing' => [
        'label' => 'Ceník',
        'icon' => 'credit-card',
        'sections' => [
            'hero' => 'Hlavička stránky',
            'enterprise' => 'Enterprise nabídka',
            'calculator' => 'Kalkulačka',
            'addons' => 'Doplňkové služby',
            'faq' => 'FAQ sekce',
            'cta' => 'CTA sekce'
        ]
    ],
    'blog' => [
        'label' => 'Blog',
        'icon' => 'file-text',
        'sections' => [
            'hero' => 'Hlavička stránky',
            'empty' => 'Prázdný stav',
            'newsletter' => 'Newsletter'
        ]
    ],
    'global' => [
        'label' => 'Globální prvky',
        'icon' => 'globe',
        'sections' => [
            'header' => 'Header',
            'footer' => 'Footer',
            'cookie' => 'Cookie lišta'
        ]
    ]
];

// Aktivní stránka z URL
$activePage = $_GET['page'] ?? 'home';
if (!isset($pageDefinitions[$activePage])) {
    $activePage = 'home';
}
?>

<div class="content-header">
    <div class="content-header__left">
        <h2>Obsah stránek</h2>
        <p class="text-muted">Upravte texty na jednotlivých stránkách webu.</p>
    </div>
</div>

<div class="page-content-layout">
    <!-- Sidebar s navigací -->
    <div class="page-content-sidebar">
        <nav class="page-content-nav">
            <?php foreach ($pageDefinitions as $pageKey => $pageDef): ?>
            <a href="/admin/page-content?page=<?= $pageKey ?>"
               class="page-content-nav__item <?= $activePage === $pageKey ? 'active' : '' ?>">
                <i data-feather="<?= $pageDef['icon'] ?>"></i>
                <span><?= $pageDef['label'] ?></span>
            </a>
            <?php endforeach; ?>
        </nav>
    </div>

    <!-- Hlavní obsah -->
    <div class="page-content-main">
        <form method="POST" class="form" id="content-form">
            <input type="hidden" name="page" value="<?= $activePage ?>">

            <?php foreach ($pageDefinitions[$activePage]['sections'] as $sectionKey => $sectionLabel): ?>
            <div class="card" style="margin-bottom: 1.5rem;">
                <div class="card__header">
                    <h3><?= $sectionLabel ?></h3>
                </div>
                <div class="card__body">
                    <?php
                    // Načíst obsah pro tuto sekci
                    $sectionContent = [];
                    foreach ($content as $item) {
                        if ($item['page'] === $activePage && $item['section'] === $sectionKey) {
                            $sectionContent[$item['field']] = $item['content'];
                        }
                    }

                    // Zobrazit pole podle sekce
                    $fields = getFieldsForSection($activePage, $sectionKey);
                    foreach ($fields as $fieldKey => $fieldDef):
                        $value = $sectionContent[$fieldKey] ?? '';
                        $inputName = "{$activePage}_{$sectionKey}_{$fieldKey}";
                    ?>
                    <div class="form-group">
                        <label for="<?= $inputName ?>"><?= $fieldDef['label'] ?></label>
                        <?php if ($fieldDef['type'] === 'textarea'): ?>
                        <textarea id="<?= $inputName ?>" name="<?= $inputName ?>"
                                  rows="<?= $fieldDef['rows'] ?? 3 ?>"
                                  class="form-input"><?= htmlspecialchars($value) ?></textarea>
                        <?php else: ?>
                        <input type="text" id="<?= $inputName ?>" name="<?= $inputName ?>"
                               value="<?= htmlspecialchars($value) ?>"
                               class="form-input">
                        <?php endif; ?>
                        <?php if (!empty($fieldDef['help'])): ?>
                        <small class="form-help"><?= $fieldDef['help'] ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="form-actions" style="position: sticky; bottom: 0; background: var(--color-bg-primary); padding: 1rem 0; border-top: 1px solid var(--color-border);">
                <button type="submit" class="btn btn--primary btn--large">
                    <i data-feather="save"></i> Uložit změny
                </button>
            </div>
        </form>
    </div>
</div>

<?php
// Funkce pro definici polí podle sekce
function getFieldsForSection($page, $section) {
    $fields = [
        'home' => [
            'hero' => [
                'badge' => ['label' => 'Badge (malý text nahoře)', 'type' => 'text'],
                'title' => ['label' => 'Hlavní nadpis (H1)', 'type' => 'text'],
                'subtitle' => ['label' => 'Podnadpis', 'type' => 'textarea', 'rows' => 2],
                'cta_primary' => ['label' => 'Primární tlačítko', 'type' => 'text'],
                'cta_secondary' => ['label' => 'Sekundární tlačítko', 'type' => 'text'],
                'float_1' => ['label' => 'Plovoucí badge 1', 'type' => 'text', 'help' => 'např. +127% tržby'],
                'float_2' => ['label' => 'Plovoucí badge 2', 'type' => 'text'],
                'float_3' => ['label' => 'Plovoucí badge 3', 'type' => 'text'],
            ],
            'stats' => [
                'stat1_value' => ['label' => 'Statistika 1 - Hodnota', 'type' => 'text', 'help' => 'např. 150+'],
                'stat1_label' => ['label' => 'Statistika 1 - Popis', 'type' => 'text', 'help' => 'např. Spokojených klientů'],
                'stat2_value' => ['label' => 'Statistika 2 - Hodnota', 'type' => 'text'],
                'stat2_label' => ['label' => 'Statistika 2 - Popis', 'type' => 'text'],
                'stat3_value' => ['label' => 'Statistika 3 - Hodnota', 'type' => 'text'],
                'stat3_label' => ['label' => 'Statistika 3 - Popis', 'type' => 'text'],
                'stat4_value' => ['label' => 'Statistika 4 - Hodnota', 'type' => 'text'],
                'stat4_label' => ['label' => 'Statistika 4 - Popis', 'type' => 'text'],
            ],
            'services' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis sekce', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
            ],
            'process' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis sekce', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
            ],
            'whyus' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis sekce', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
                'item1_title' => ['label' => 'Položka 1 - Nadpis', 'type' => 'text'],
                'item1_text' => ['label' => 'Položka 1 - Text', 'type' => 'textarea', 'rows' => 2],
                'item2_title' => ['label' => 'Položka 2 - Nadpis', 'type' => 'text'],
                'item2_text' => ['label' => 'Položka 2 - Text', 'type' => 'textarea', 'rows' => 2],
                'item3_title' => ['label' => 'Položka 3 - Nadpis', 'type' => 'text'],
                'item3_text' => ['label' => 'Položka 3 - Text', 'type' => 'textarea', 'rows' => 2],
                'item4_title' => ['label' => 'Položka 4 - Nadpis', 'type' => 'text'],
                'item4_text' => ['label' => 'Položka 4 - Text', 'type' => 'textarea', 'rows' => 2],
            ],
            'video' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis sekce', 'type' => 'text'],
                'placeholder' => ['label' => 'Placeholder text', 'type' => 'text'],
            ],
            'certifications' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis sekce', 'type' => 'text'],
            ],
            'pricing' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis sekce', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
                'cta' => ['label' => 'Text tlačítka', 'type' => 'text'],
            ],
            'testimonials' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis sekce', 'type' => 'text'],
                'link' => ['label' => 'Text odkazu', 'type' => 'text'],
            ],
            'faq' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis sekce', 'type' => 'text'],
            ],
            'cta' => [
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
                'button' => ['label' => 'Text tlačítka', 'type' => 'text'],
            ],
        ],
        'about' => [
            'hero' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Hlavní nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
            ],
            'story' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
                'text' => ['label' => 'Text příběhu', 'type' => 'textarea', 'rows' => 8, 'help' => 'Můžete použít odstavce oddělené prázdným řádkem.'],
            ],
            'values' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
            ],
            'team' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
            ],
            'stats' => [
                'stat1_value' => ['label' => 'Statistika 1 - Hodnota', 'type' => 'text', 'help' => 'např. 5+'],
                'stat1_label' => ['label' => 'Statistika 1 - Popis', 'type' => 'text'],
                'stat2_value' => ['label' => 'Statistika 2 - Hodnota', 'type' => 'text'],
                'stat2_label' => ['label' => 'Statistika 2 - Popis', 'type' => 'text'],
                'stat3_value' => ['label' => 'Statistika 3 - Hodnota', 'type' => 'text'],
                'stat3_label' => ['label' => 'Statistika 3 - Popis', 'type' => 'text'],
                'stat4_value' => ['label' => 'Statistika 4 - Hodnota', 'type' => 'text'],
                'stat4_label' => ['label' => 'Statistika 4 - Popis', 'type' => 'text'],
            ],
            'cta' => [
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
                'button' => ['label' => 'Text tlačítka', 'type' => 'text'],
            ],
        ],
        'contact' => [
            'hero' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Hlavní nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
            ],
            'form' => [
                'title' => ['label' => 'Nadpis formuláře', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'text'],
                'button' => ['label' => 'Text tlačítka', 'type' => 'text'],
            ],
            'info' => [
                'working_hours' => ['label' => 'Pracovní doba', 'type' => 'text'],
            ],
            'social' => [
                'title' => ['label' => 'Nadpis sekce', 'type' => 'text'],
            ],
        ],
        'services' => [
            'hero' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Hlavní nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
            ],
            'cta' => [
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
                'button' => ['label' => 'Text tlačítka', 'type' => 'text'],
            ],
        ],
        'references' => [
            'hero' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Hlavní nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
            ],
            'clients' => [
                'title' => ['label' => 'Nadpis sekce', 'type' => 'text'],
            ],
            'cta' => [
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
                'button' => ['label' => 'Text tlačítka', 'type' => 'text'],
            ],
        ],
        'pricing' => [
            'hero' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Hlavní nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
            ],
            'enterprise' => [
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'text'],
                'button' => ['label' => 'Text tlačítka', 'type' => 'text'],
            ],
            'calculator' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'text'],
                'result_label' => ['label' => 'Popis výsledku', 'type' => 'text'],
                'button' => ['label' => 'Text tlačítka', 'type' => 'text'],
            ],
            'addons' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
            ],
            'faq' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
            ],
            'cta' => [
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
                'button' => ['label' => 'Text tlačítka', 'type' => 'text'],
            ],
        ],
        'blog' => [
            'hero' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Hlavní nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
            ],
            'empty' => [
                'title' => ['label' => 'Nadpis (prázdný stav)', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
            ],
            'newsletter' => [
                'badge' => ['label' => 'Badge', 'type' => 'text'],
                'title' => ['label' => 'Nadpis', 'type' => 'text'],
                'description' => ['label' => 'Popis', 'type' => 'textarea', 'rows' => 2],
                'button' => ['label' => 'Text tlačítka', 'type' => 'text'],
                'privacy' => ['label' => 'Text o soukromí', 'type' => 'text'],
            ],
        ],
        'global' => [
            'header' => [
                'cta' => ['label' => 'Text CTA tlačítka', 'type' => 'text'],
            ],
            'footer' => [
                'description' => ['label' => 'Popis společnosti', 'type' => 'textarea', 'rows' => 2],
                'newsletter_title' => ['label' => 'Newsletter - Nadpis', 'type' => 'text'],
                'newsletter_description' => ['label' => 'Newsletter - Popis', 'type' => 'text'],
                'copyright' => ['label' => 'Copyright text', 'type' => 'text', 'help' => 'Použijte [YEAR] pro aktuální rok'],
            ],
            'cookie' => [
                'message' => ['label' => 'Zpráva cookie lišty', 'type' => 'textarea', 'rows' => 2],
                'link' => ['label' => 'Text odkazu', 'type' => 'text'],
                'accept' => ['label' => 'Tlačítko Přijmout', 'type' => 'text'],
                'reject' => ['label' => 'Tlačítko Odmítnout', 'type' => 'text'],
            ],
        ],
    ];

    return $fields[$page][$section] ?? [];
}
?>

<style>
.page-content-layout {
    display: grid;
    grid-template-columns: 220px 1fr;
    gap: 1.5rem;
    align-items: start;
}

.page-content-sidebar {
    position: sticky;
    top: 1rem;
}

.page-content-nav {
    background: var(--color-bg-card);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    overflow: hidden;
}

.page-content-nav__item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1rem;
    color: var(--color-text-secondary);
    text-decoration: none;
    border-bottom: 1px solid var(--color-border);
    transition: all 0.2s;
}

.page-content-nav__item:last-child {
    border-bottom: none;
}

.page-content-nav__item:hover {
    background: var(--color-bg-hover);
    color: var(--color-text-primary);
}

.page-content-nav__item.active {
    background: var(--color-accent-secondary);
    color: white;
}

.page-content-nav__item svg {
    width: 18px;
    height: 18px;
}

.page-content-main {
    min-width: 0;
}

.form-help {
    display: block;
    margin-top: 0.25rem;
    color: var(--color-text-muted);
    font-size: 0.8125rem;
}

@media (max-width: 768px) {
    .page-content-layout {
        grid-template-columns: 1fr;
    }

    .page-content-sidebar {
        position: static;
    }

    .page-content-nav {
        display: flex;
        overflow-x: auto;
    }

    .page-content-nav__item {
        flex-shrink: 0;
        border-bottom: none;
        border-right: 1px solid var(--color-border);
    }
}
</style>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>
