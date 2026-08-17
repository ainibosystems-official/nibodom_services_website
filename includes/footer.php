<?php
// Footer translations
$footer = [
  'bg' => [
    'tagline' => 'Airbnb и управление на имоти в Бургас',
    'contact' => 'Контакт',
    'area'    => 'Обслужвана зона',
    'areaTxt' => 'Бургас и Бургаска област<br>Краткосрочни и дългосрочни наеми',
    'credit'  => 'Проектирано и поддържано от',
    'rights'  => 'Всички права запазени.',
    'privacy' => 'Политика за поверителност'
  ],
  'en' => [
    'tagline' => 'Airbnb & Property Management in Burgas',
    'contact' => 'Contact',
    'area'    => 'Service Area',
    'areaTxt' => 'Burgas & Burgas District<br>Short & long-term rentals',
    'credit'  => 'Designed & powered by',
    'rights'  => 'All rights reserved.',
    'privacy' => 'Privacy Policy'
  ],
  'ua' => [
    'tagline' => 'Управління Airbnb та нерухомістю в Бургасі',
    'contact' => 'Контакт',
    'area'    => 'Зона обслуговування',
    'areaTxt' => 'Бургас та Бургаський регіон<br>Коротко- та довгострокова оренда',
    'credit'  => 'Розроблено та підтримується',
    'rights'  => 'Усі права захищені.',
    'privacy' => 'Політика конфіденційності'
  ]
];

// Safety fallback
if (!isset($footer[$lang])) {
  $lang = 'en';
}
?>

<footer class="site-footer">

  <!-- MAIN FOOTER CONTENT -->
  <div class="footer-content">
    <div class="footer-inner">

      <!-- Brand -->
      <div class="footer-block footer-brand">
        <div class="footer-logo">
          <img src="/assets/images/logo.svg" alt="NiBoDom">
        </div>
        <p class="footer-text">
          NiBoDom Services<br>
          <?= $footer[$lang]['tagline']; ?>
        </p>
      </div>

      <!-- Contact -->
      <div class="footer-block">
        <h4><?= $footer[$lang]['contact']; ?></h4>
        <p class="footer-contact">
          📞 +359 877 21 56 36<br>
          💬 WhatsApp<br>
          ✉️ nibodom@gmail.com<br>

          <span class="footer-social">
            <svg
              viewBox="0 0 24 24"
              width="14"
              height="14"
              aria-hidden="true">
              <path d="M22 12.07C22 6.48 17.52 2 11.93 2S1.86 6.48 1.86 12.07c0 4.99 3.66 9.13 8.44 9.93v-7.03H7.9v-2.9h2.4V9.85c0-2.37 1.4-3.68 3.55-3.68 1.03 0 2.1.18 2.1.18v2.3h-1.18c-1.16 0-1.52.72-1.52 1.46v1.76h2.59l-.41 2.9h-2.18V22c4.78-.8 8.44-4.94 8.44-9.93Z" />
            </svg>

            <a
              href="https://www.facebook.com/NiboDomServicesBurgas"
              target="_blank"
              rel="noopener">
              Facebook
            </a>
          </span>
        </p>

      </div>

      <!-- Area -->
      <div class="footer-block">
        <h4><?= $footer[$lang]['area']; ?></h4>
        <p><?= $footer[$lang]['areaTxt']; ?></p>

        <!-- Connected service -->
        <p class="footer-related">
          <?php if ($lang === 'bg'): ?>
            <strong>Виж също:</strong>
            <a href="https://nibofix.com" target="_blank" rel="noopener">
              NiBoFix
            </a>
          <?php elseif ($lang === 'ua'): ?>
            <strong>Дивіться також:</strong>
            <a href="https://nibofix.com" target="_blank" rel="noopener">
              NiBoFix
            </a>
          <?php else: ?>
            <strong>See also:</strong>
            <a href="https://nibofix.com" target="_blank" rel="noopener">
              NiBoFix
            </a>
          <?php endif; ?>
        </p>

      </div>

    </div>
  </div>

  <!-- FOOTER BOTTOM (LEGAL / CREDIT) -->
  <div class="footer-bottom">
    <div class="footer-bottom-inner">

      <p>
        © <?= date('Y'); ?> NiBoDom Services.
        <?= $footer[$lang]['rights']; ?>
      </p>

      <p class="footer-links">
        <a href="/<?= $lang ?>/privacy.php">
          <?= $footer[$lang]['privacy']; ?>
        </a>
      </p>

      <p class="footer-credit">
        <?= $footer[$lang]['credit']; ?>
        <a href="https://ainibosystems.bg" target="_blank" rel="noopener">
          AiNiBo Systems
        </a>
      </p>

    </div>
  </div>

</footer>
<script src="/assets/js/faq.js" defer></script>

</body>

</html>