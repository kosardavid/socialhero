<?php
$pageTitle = 'Nastavení';
$currentPage = 'settings';

ob_start();
?>

<form method="POST" action="/admin/settings">
    <div class="card">
        <div class="card__header">
            <h3>Obecné nastavení</h3>
        </div>
        <div class="card__body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Název webu</label>
                    <input type="text" name="site_name" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['site_name'] ?? 'SocialHero') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Popis webu</label>
                    <input type="text" name="site_description" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['site_description'] ?? '') ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>Kontaktní údaje</h3>
        </div>
        <div class="card__body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="contact_email" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['contact_email'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Telefon</label>
                    <input type="text" name="contact_phone" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['contact_phone'] ?? '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Adresa</label>
                <input type="text" name="contact_address" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['contact_address'] ?? '') ?>">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>Sociální sítě</h3>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label class="form-label">Facebook URL</label>
                <input type="url" name="social_facebook" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['social_facebook'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Instagram URL</label>
                <input type="url" name="social_instagram" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['social_instagram'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <input type="url" name="social_linkedin" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['social_linkedin'] ?? '') ?>">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>Video sekce (Homepage)</h3>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label class="form-label">YouTube Video ID</label>
                <input type="text" name="youtube_video_id" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['youtube_video_id'] ?? '') ?>"
                       placeholder="např. dQw4w9WgXcQ">
                <small style="color: var(--color-text-muted);">ID z URL: youtube.com/watch?v=<strong>dQw4w9WgXcQ</strong></small>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>Ukázka Reels - Telefony (Homepage)</h3>
        </div>
        <div class="card__body">
            <p style="color: var(--color-text-muted); margin-bottom: 1.5rem;">
                Nastavte obsah pro 3 telefony v sekci "A jak to vypadá?". Každý telefon může obsahovat video, obrázek nebo text.
            </p>

            <!-- Phone 1 -->
            <div style="background: var(--color-bg-tertiary); padding: 1.5rem; border-radius: var(--radius-lg); margin-bottom: 1.5rem;">
                <h4 style="margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i data-feather="smartphone" style="width: 18px; height: 18px;"></i>
                    Telefon 1 (Levý)
                </h4>
                <div class="form-group">
                    <label class="form-label">Typ obsahu</label>
                    <select name="reel_1_type" class="form-input" onchange="toggleReelFields(1, this.value)">
                        <option value="video" <?= ($settingsArray['reel_1_type'] ?? 'video') === 'video' ? 'selected' : '' ?>>Video (MP4)</option>
                        <option value="youtube" <?= ($settingsArray['reel_1_type'] ?? '') === 'youtube' ? 'selected' : '' ?>>YouTube Short</option>
                        <option value="image" <?= ($settingsArray['reel_1_type'] ?? '') === 'image' ? 'selected' : '' ?>>Obrázek</option>
                        <option value="text" <?= ($settingsArray['reel_1_type'] ?? '') === 'text' ? 'selected' : '' ?>>Text</option>
                    </select>
                </div>
                <div class="form-group reel-field reel-1-video" style="display: <?= ($settingsArray['reel_1_type'] ?? 'video') === 'video' ? 'block' : 'none' ?>;">
                    <label class="form-label">URL videa (MP4)</label>
                    <input type="text" name="reel_1_video" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_1_video'] ?? '') ?>"
                           placeholder="/assets/videos/reel1.mp4 nebo https://...">
                    <small style="color: var(--color-text-muted);">Nahrajte MP4 video do /assets/videos/ nebo použijte externí URL.</small>
                </div>
                <div class="form-group reel-field reel-1-youtube" style="display: <?= ($settingsArray['reel_1_type'] ?? '') === 'youtube' ? 'block' : 'none' ?>;">
                    <label class="form-label">YouTube Video ID</label>
                    <input type="text" name="reel_1_youtube" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_1_youtube'] ?? '') ?>"
                           placeholder="např. dQw4w9WgXcQ">
                    <small style="color: var(--color-text-muted);">ID z URL: youtube.com/watch?v=<strong>ID</strong> nebo youtube.com/shorts/<strong>ID</strong></small>
                </div>
                <div class="form-group reel-field reel-1-image" style="display: <?= ($settingsArray['reel_1_type'] ?? '') === 'image' ? 'block' : 'none' ?>;">
                    <label class="form-label">URL obrázku</label>
                    <input type="text" name="reel_1_image" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_1_image'] ?? '') ?>"
                           placeholder="/assets/images/reel1.jpg nebo https://...">
                </div>
                <div class="form-group reel-field reel-1-text" style="display: <?= ($settingsArray['reel_1_type'] ?? '') === 'text' ? 'block' : 'none' ?>;">
                    <label class="form-label">Text obsah</label>
                    <textarea name="reel_1_text" class="form-input" rows="3"
                              placeholder="Např. +150% engagement"><?= htmlspecialchars($settingsArray['reel_1_text'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Popisek (volitelné)</label>
                    <input type="text" name="reel_1_label" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_1_label'] ?? '') ?>"
                           placeholder="např. Fashion Brand">
                </div>
            </div>

            <!-- Phone 2 -->
            <div style="background: var(--color-bg-tertiary); padding: 1.5rem; border-radius: var(--radius-lg); margin-bottom: 1.5rem;">
                <h4 style="margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i data-feather="smartphone" style="width: 18px; height: 18px;"></i>
                    Telefon 2 (Střední - hlavní)
                </h4>
                <div class="form-group">
                    <label class="form-label">Typ obsahu</label>
                    <select name="reel_2_type" class="form-input" onchange="toggleReelFields(2, this.value)">
                        <option value="video" <?= ($settingsArray['reel_2_type'] ?? 'video') === 'video' ? 'selected' : '' ?>>Video (MP4)</option>
                        <option value="youtube" <?= ($settingsArray['reel_2_type'] ?? '') === 'youtube' ? 'selected' : '' ?>>YouTube Short</option>
                        <option value="image" <?= ($settingsArray['reel_2_type'] ?? '') === 'image' ? 'selected' : '' ?>>Obrázek</option>
                        <option value="text" <?= ($settingsArray['reel_2_type'] ?? '') === 'text' ? 'selected' : '' ?>>Text</option>
                    </select>
                </div>
                <div class="form-group reel-field reel-2-video" style="display: <?= ($settingsArray['reel_2_type'] ?? 'video') === 'video' ? 'block' : 'none' ?>;">
                    <label class="form-label">URL videa (MP4)</label>
                    <input type="text" name="reel_2_video" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_2_video'] ?? '') ?>"
                           placeholder="/assets/videos/reel2.mp4 nebo https://...">
                </div>
                <div class="form-group reel-field reel-2-youtube" style="display: <?= ($settingsArray['reel_2_type'] ?? '') === 'youtube' ? 'block' : 'none' ?>;">
                    <label class="form-label">YouTube Video ID</label>
                    <input type="text" name="reel_2_youtube" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_2_youtube'] ?? '') ?>"
                           placeholder="např. dQw4w9WgXcQ">
                    <small style="color: var(--color-text-muted);">ID z URL: youtube.com/watch?v=<strong>ID</strong> nebo youtube.com/shorts/<strong>ID</strong></small>
                </div>
                <div class="form-group reel-field reel-2-image" style="display: <?= ($settingsArray['reel_2_type'] ?? '') === 'image' ? 'block' : 'none' ?>;">
                    <label class="form-label">URL obrázku</label>
                    <input type="text" name="reel_2_image" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_2_image'] ?? '') ?>"
                           placeholder="/assets/images/reel2.jpg nebo https://...">
                </div>
                <div class="form-group reel-field reel-2-text" style="display: <?= ($settingsArray['reel_2_type'] ?? '') === 'text' ? 'block' : 'none' ?>;">
                    <label class="form-label">Text obsah</label>
                    <textarea name="reel_2_text" class="form-input" rows="3"
                              placeholder="Např. +150% engagement"><?= htmlspecialchars($settingsArray['reel_2_text'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Popisek (volitelné)</label>
                    <input type="text" name="reel_2_label" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_2_label'] ?? '') ?>"
                           placeholder="např. Restaurant">
                </div>
            </div>

            <!-- Phone 3 -->
            <div style="background: var(--color-bg-tertiary); padding: 1.5rem; border-radius: var(--radius-lg);">
                <h4 style="margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i data-feather="smartphone" style="width: 18px; height: 18px;"></i>
                    Telefon 3 (Pravý)
                </h4>
                <div class="form-group">
                    <label class="form-label">Typ obsahu</label>
                    <select name="reel_3_type" class="form-input" onchange="toggleReelFields(3, this.value)">
                        <option value="video" <?= ($settingsArray['reel_3_type'] ?? 'video') === 'video' ? 'selected' : '' ?>>Video (MP4)</option>
                        <option value="youtube" <?= ($settingsArray['reel_3_type'] ?? '') === 'youtube' ? 'selected' : '' ?>>YouTube Short</option>
                        <option value="image" <?= ($settingsArray['reel_3_type'] ?? '') === 'image' ? 'selected' : '' ?>>Obrázek</option>
                        <option value="text" <?= ($settingsArray['reel_3_type'] ?? '') === 'text' ? 'selected' : '' ?>>Text</option>
                    </select>
                </div>
                <div class="form-group reel-field reel-3-video" style="display: <?= ($settingsArray['reel_3_type'] ?? 'video') === 'video' ? 'block' : 'none' ?>;">
                    <label class="form-label">URL videa (MP4)</label>
                    <input type="text" name="reel_3_video" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_3_video'] ?? '') ?>"
                           placeholder="/assets/videos/reel3.mp4 nebo https://...">
                </div>
                <div class="form-group reel-field reel-3-youtube" style="display: <?= ($settingsArray['reel_3_type'] ?? '') === 'youtube' ? 'block' : 'none' ?>;">
                    <label class="form-label">YouTube Video ID</label>
                    <input type="text" name="reel_3_youtube" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_3_youtube'] ?? '') ?>"
                           placeholder="např. dQw4w9WgXcQ">
                    <small style="color: var(--color-text-muted);">ID z URL: youtube.com/watch?v=<strong>ID</strong> nebo youtube.com/shorts/<strong>ID</strong></small>
                </div>
                <div class="form-group reel-field reel-3-image" style="display: <?= ($settingsArray['reel_3_type'] ?? '') === 'image' ? 'block' : 'none' ?>;">
                    <label class="form-label">URL obrázku</label>
                    <input type="text" name="reel_3_image" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_3_image'] ?? '') ?>"
                           placeholder="/assets/images/reel3.jpg nebo https://...">
                </div>
                <div class="form-group reel-field reel-3-text" style="display: <?= ($settingsArray['reel_3_type'] ?? '') === 'text' ? 'block' : 'none' ?>;">
                    <label class="form-label">Text obsah</label>
                    <textarea name="reel_3_text" class="form-input" rows="3"
                              placeholder="Např. +150% engagement"><?= htmlspecialchars($settingsArray['reel_3_text'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Popisek (volitelné)</label>
                    <input type="text" name="reel_3_label" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['reel_3_label'] ?? '') ?>"
                           placeholder="např. E-shop">
                </div>
            </div>
        </div>
    </div>

    <script>
    function toggleReelFields(phoneNum, type) {
        document.querySelectorAll('.reel-' + phoneNum + '-video, .reel-' + phoneNum + '-youtube, .reel-' + phoneNum + '-image, .reel-' + phoneNum + '-text').forEach(el => {
            el.style.display = 'none';
        });
        document.querySelectorAll('.reel-' + phoneNum + '-' + type).forEach(el => {
            el.style.display = 'block';
        });
    }
    </script>

    <div class="card">
        <div class="card__header">
            <h3>Live Chat (Tawk.to)</h3>
        </div>
        <div class="card__body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tawk.to Property ID</label>
                    <input type="text" name="tawkto_property_id" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['tawkto_property_id'] ?? '') ?>"
                           placeholder="např. 1234567890abcdef">
                </div>
                <div class="form-group">
                    <label class="form-label">Tawk.to Widget ID</label>
                    <input type="text" name="tawkto_widget_id" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['tawkto_widget_id'] ?? '') ?>"
                           placeholder="např. 1a2b3c4d">
                </div>
            </div>
            <small style="color: var(--color-text-muted);">Registrace zdarma na <a href="https://www.tawk.to/" target="_blank" style="color: var(--color-accent-secondary);">tawk.to</a>. ID najdete v nastavení widgetu.</small>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>Cenová kalkulačka</h3>
        </div>
        <div class="card__body">
            <p style="color: var(--color-text-muted); margin-bottom: 1rem;">Nastavte základní ceny služeb pro kalkulačku na stránce Ceník.</p>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Správa soc. sítí (Kč/měs.)</label>
                    <input type="number" name="calc_social" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['calc_social'] ?? '8000') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Meta Ads (Kč/měs.)</label>
                    <input type="number" name="calc_meta" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['calc_meta'] ?? '6000') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Google Ads (Kč/měs.)</label>
                    <input type="number" name="calc_google" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['calc_google'] ?? '6000') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">E-mail marketing (Kč/měs.)</label>
                    <input type="number" name="calc_email" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['calc_email'] ?? '4000') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">SEO optimalizace (Kč/měs.)</label>
                    <input type="number" name="calc_seo" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['calc_seo'] ?? '8000') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Tvorba obsahu (Kč/měs.)</label>
                    <input type="number" name="calc_content" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['calc_content'] ?? '5000') ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>Tracking & Analytics</h3>
        </div>
        <div class="card__body">
            <p style="color: var(--color-text-muted); margin-bottom: 1rem;">Nastavte tracking kódy pro měření návštěvnosti a konverzí.</p>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Google Tag Manager ID</label>
                    <input type="text" name="gtm_id" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['gtm_id'] ?? '') ?>"
                           placeholder="GTM-XXXXXXX">
                    <small style="color: var(--color-text-muted);">Např. GTM-ABC123. Vloží GTM do HEAD i BODY.</small>
                </div>
                <div class="form-group">
                    <label class="form-label">Google Analytics 4 ID</label>
                    <input type="text" name="ga4_id" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['ga4_id'] ?? '') ?>"
                           placeholder="G-XXXXXXXXXX">
                    <small style="color: var(--color-text-muted);">Např. G-ABC123XYZ. Použijte pokud nemáte GTM.</small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Google Ads Conversion ID</label>
                    <input type="text" name="gads_id" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['gads_id'] ?? '') ?>"
                           placeholder="AW-XXXXXXXXX">
                    <small style="color: var(--color-text-muted);">Pro měření konverzí z Google Ads.</small>
                </div>
                <div class="form-group">
                    <label class="form-label">Facebook Pixel ID</label>
                    <input type="text" name="fb_pixel_id" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['fb_pixel_id'] ?? '') ?>"
                           placeholder="123456789012345">
                    <small style="color: var(--color-text-muted);">15místné číslo z Meta Business Suite.</small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Seznam Sklik ID</label>
                    <input type="text" name="sklik_id" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['sklik_id'] ?? '') ?>"
                           placeholder="123456">
                    <small style="color: var(--color-text-muted);">Retargeting ID ze Skliku.</small>
                </div>
                <div class="form-group">
                    <label class="form-label">Ecomail App ID</label>
                    <input type="text" name="ecomail_id" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['ecomail_id'] ?? '') ?>"
                           placeholder="app-xxxxxxxx">
                    <small style="color: var(--color-text-muted);">Pro sledování z Ecomailu.</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>Vlastní skripty</h3>
        </div>
        <div class="card__body">
            <p style="color: var(--color-text-muted); margin-bottom: 1rem;">Pro pokročilé uživatele - vlastní kód do HEAD nebo BODY sekce.</p>

            <div class="form-group">
                <label class="form-label">Vlastní kód do HEAD</label>
                <textarea name="custom_head_scripts" class="form-input" rows="4"
                          placeholder="<script>...</script> nebo <meta ...>"><?= htmlspecialchars($settingsArray['custom_head_scripts'] ?? '') ?></textarea>
                <small style="color: var(--color-text-muted);">Vloží se před &lt;/head&gt;. Použijte pro meta tagy, vlastní CSS, apod.</small>
            </div>

            <div class="form-group">
                <label class="form-label">Vlastní kód do BODY (konec)</label>
                <textarea name="custom_body_scripts" class="form-input" rows="4"
                          placeholder="<script>...</script>"><?= htmlspecialchars($settingsArray['custom_body_scripts'] ?? '') ?></textarea>
                <small style="color: var(--color-text-muted);">Vloží se před &lt;/body&gt;. Použijte pro tracking skripty třetích stran.</small>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>SEO - Výchozí meta tagy</h3>
        </div>
        <div class="card__body">
            <p style="color: var(--color-text-muted); margin-bottom: 1rem;">Výchozí hodnoty pro SEO. Jednotlivé stránky mohou mít vlastní.</p>

            <div class="form-group">
                <label class="form-label">Výchozí meta title</label>
                <input type="text" name="default_meta_title" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['default_meta_title'] ?? '') ?>"
                       placeholder="SocialHero - Online Marketing na Klíč">
                <small style="color: var(--color-text-muted);">Doporučeno 50-60 znaků.</small>
            </div>

            <div class="form-group">
                <label class="form-label">Výchozí meta description</label>
                <textarea name="default_meta_description" class="form-input" rows="2"
                          placeholder="Kompletní online marketing v jednom předplatném..."><?= htmlspecialchars($settingsArray['default_meta_description'] ?? '') ?></textarea>
                <small style="color: var(--color-text-muted);">Doporučeno 150-160 znaků.</small>
            </div>

            <div class="form-group">
                <label class="form-label">Meta keywords</label>
                <input type="text" name="default_meta_keywords" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['default_meta_keywords'] ?? '') ?>"
                       placeholder="online marketing, sociální sítě, meta ads, google ads">
                <small style="color: var(--color-text-muted);">Oddělujte čárkou. (Menší význam pro SEO, ale některé vyhledávače je čtou.)</small>
            </div>
        </div>
    </div>

    <div class="form-actions form-actions--floating">
        <button type="submit" class="btn btn--primary">
            <i data-feather="save"></i>
            Uložit nastavení
        </button>
    </div>
</form>

<form method="POST" action="/admin/settings/password" style="margin-top: 2rem;">
    <div class="card">
        <div class="card__header">
            <h3>Změna hesla</h3>
        </div>
        <div class="card__body">
            <?php if (isset($_SESSION['password_success'])): ?>
                <div class="alert alert--success" style="margin-bottom: 1rem;">
                    <?= htmlspecialchars($_SESSION['password_success']) ?>
                </div>
                <?php unset($_SESSION['password_success']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['password_error'])): ?>
                <div class="alert alert--error" style="margin-bottom: 1rem;">
                    <?= htmlspecialchars($_SESSION['password_error']) ?>
                </div>
                <?php unset($_SESSION['password_error']); ?>
            <?php endif; ?>

            <div class="form-group">
                <label class="form-label">Aktuální heslo</label>
                <input type="password" name="current_password" class="form-input" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nové heslo</label>
                    <input type="password" name="new_password" class="form-input" required minlength="8">
                    <small style="color: var(--color-text-muted);">Minimálně 8 znaků.</small>
                </div>
                <div class="form-group">
                    <label class="form-label">Potvrzení nového hesla</label>
                    <input type="password" name="confirm_password" class="form-input" required minlength="8">
                </div>
            </div>
        </div>
        <div class="card__footer">
            <button type="submit" class="btn btn--secondary">
                <i data-feather="lock"></i>
                Změnit heslo
            </button>
        </div>
    </div>
</form>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>
