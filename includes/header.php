<?php
// Detect language from folder
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $path);
$lang = $segments[0] ?? 'bg';

if (!in_array($lang, ['bg', 'en', 'ua'])) {
  $lang = 'bg';
}

// Navigation labels by language
$nav = [
  'bg' => [
    'services'   => 'Услуги',
    'how'        => 'Как работи',
    'about'      => 'За Нас',
    'properties' => 'Имоти',
    'contact'    => 'Контакт',
    'faq'        => 'Въпроси'

  ],
  'en' => [
    'services'   => 'Services',
    'how'        => 'How it works',
    'about'      => 'About Us',
    'properties' => 'Properties',
    'contact'    => 'Contact',
    'faq'        => 'FAQ'

  ],
  'ua' => [
    'services'   => 'Послуги',
    'how'        => 'Як це працює',
    'about'      => 'Про Нас',
    'properties' => 'Нерухомість',
    'contact'    => 'Контакт',
    'faq'        => 'Поширені запитання'

  ]
];

// Fallback safety
if (!isset($nav[$lang])) {
  $lang = 'en';
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>
    <?= $lang === 'bg'
      ? 'Управление на имоти в Бургас – NiBoDom'
      : ($lang === 'ua'
        ? 'Управління нерухомістю в Бургасі – NiBoDom'
        : 'Property Management in Burgas – NiBoDom'); ?>
  </title>

  <?php
  $ogTitle = $lang === 'bg'
    ? 'Управление на имоти в Бургас – NiBoDom'
    : ($lang === 'ua'
      ? 'Управління нерухомістю в Бургасі – NiBoDom'
      : 'Property Management in Burgas – NiBoDom');

  $ogDescription = $lang === 'bg'
    ? 'Професионално управление, почистване и поддръжка на имоти в Бургас.'
    : ($lang === 'ua'
      ? 'Професійне управління, прибирання та обслуговування нерухомості в Бургасі.'
      : 'Professional property management, cleaning and home care services in Burgas.');
  ?>

  <!-- Open Graph / Social -->
  <meta property="og:type" content="website">
  <meta property="og:locale" content="<?= $lang === 'bg' ? 'bg_BG' : ($lang === 'ua' ? 'uk_UA' : 'en_US') ?>">
  <meta property="og:site_name" content="NiBoDom Services">
  <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($ogDescription) ?>">
  <meta property="og:image" content="https://nibodom.com/assets/images/og.png">
  <meta property="og:url" content="https://nibodom.com/<?= $lang ?>/">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($ogTitle) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($ogDescription) ?>">
  <meta name="twitter:image" content="https://nibodom.com/assets/images/og.png">


  <!-- FAVICONS -->
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="shortcut icon" href="/favicon.ico">
  <meta name="theme-color" content="#F5C842">

  <!-- STYLES -->
  <link rel="stylesheet" href="/assets/css/main.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="/assets/css/faq.css?v=<?= time(); ?>">
</head>

<body>

  <header class="site-header">
    <div class="container header-inner">

      <!-- LOGO -->
      <a href="/<?= $lang ?>/" class="logo">
        <img src="/assets/images/logo.svg" alt="NiBoDom">
      </a>

      <!-- MOBILE TOGGLE -->
      <button class="nav-toggle" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <!-- NAVIGATION -->
      <nav class="site-nav mobile-nav" id="mobileNav">

        <ul>
          <li><a href="/<?= $lang ?>/#services"><?= $nav[$lang]['services']; ?></a></li>
          <li><a href="/<?= $lang ?>/#how"><?= $nav[$lang]['how']; ?></a></li>
          <li><a href="/<?= $lang ?>/#about"><?= $nav[$lang]['about']; ?></a></li>
          <li><a href="/<?= $lang ?>/#contact"><?= $nav[$lang]['contact']; ?></a></li>
          <li><a href="/<?= $lang ?>/faq.php"><?= $nav[$lang]['faq']; ?></a></li>
        </ul>

        <!-- LANGUAGE SWITCH (DESKTOP DROPDOWN) -->
        <div class="lang-switch lang-dropdown">
          <button class="lang-current" aria-haspopup="true">
            <?= strtoupper($lang) ?>
            <span class="chevron">▾</span>
          </button>

          <div class="lang-menu">
            <a href="/bg/" class="<?= $lang === 'bg' ? 'active' : '' ?>">BG</a>
            <a href="/en/" class="<?= $lang === 'en' ? 'active' : '' ?>">EN</a>
            <a href="/ua/" class="<?= $lang === 'ua' ? 'active' : '' ?>">UA</a>
          </div>
        </div>

        <!-- LANGUAGE SWITCH (MOBILE BUTTONS) -->
        <div class="lang-switch lang-mobile">
          <a href="/bg/" class="<?= $lang === 'bg' ? 'active' : '' ?>">BG</a>
          <a href="/en/" class="<?= $lang === 'en' ? 'active' : '' ?>">EN</a>
          <a href="/ua/" class="<?= $lang === 'ua' ? 'active' : '' ?>">UA</a>
        </div>

      </nav>


    </div>
  </header>

  <script src="/assets/js/main.js"></script>