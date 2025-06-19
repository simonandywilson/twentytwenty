<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>
  <?= css([
    'assets/css/styles.css',
    '@auto'
  ]) ?>
  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">
</head>
<body>
  <header class="sticky top-0 w-full font-sans z-50 selection:bg-zinc-500/50 md:fixed md:w-[50vw] md:right-0 ">
    <button onclick="toggleMenu()" aria-label="Toggle menu" aria-expanded="false" class="sticky top-0 z-[100] container bg-theme-menu leading-tight w-full max-w-full md:hidden font-bold">Menu</button>
    <div class="hidden w-full max-w-[100vw] h-[calc(100vh-40px)] overflow-y-scroll right-0 rounded-2xl md:h-screen md:pl-4 md:block lg:max-w-4xl" id="site-menu">
      <?php if ($page->template()->name() !== 'home'): ?>
        <a href="#main-content" class="block rounded-3xl p-3 secondary-details container bg-theme-home max-w-full has-[:focus]:ring-2 ring-black max-md:-mt-[1px] sr-only focus:static focus:p-3 focus:h-max focus:w-full focus:block">
            <h1 class="leading-tight font-bold">Skip to main content</h1>
        </a>
      <?php endif ?>
      <h1 class="sr-only">Menu</h1>
      <a href="/" class="w-full h-max block rounded-3xl p-3 secondary-details container bg-theme-home max-w-full has-[:focus-visible]:ring-2 ring-black max-md:-mt-[1px]">
        <h2 class="leading-tight font-bold">Home</h2>
      </a>
      <div class="w-full grid grid-cols-2" id="site-menu-content">
        <div class="w-full col-span-2 lg:col-span-1">
          <?php snippet('menu/artists') ?>
        </div>
        <div id="secondary-menus" class="w-full col-span-2 lg:col-span-1 max-md:mb-[0px]">
          <?php snippet('menu/essays') ?>
          <?php snippet('menu/recordings') ?>
          <?php snippet('menu/introduction') ?>
          <?php snippet('menu/contact') ?>
          <?php snippet('menu/accessibility') ?>
          <?php snippet('menu/sponsors') ?>
        </div>
      </div>
    </div>
  </header>
  <main class="relative w-full font-sans selection:bg-zinc-500/50 md:pr-4 md:w-1/2">


