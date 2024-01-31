<!DOCTYPE html>
<html lang="en">

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
  <header class="sticky top-0 w-full font-sans z-50  selection:bg-zinc-500/50 md:fixed md:w-[50vw] md:right-0 ">
    <button onclick="toggleMenu()" class="sticky top-0 z-[100] container bg-theme-menu leading-none w-full max-w-full md:hidden">Menu</button>
    <div class="hidden w-full max-w-[100vw] h-[calc(100vh-40px)] overflow-y-scroll right-0 rounded-2xl md:h-screen md:pl-4 md:block lg:max-w-2xl" id="siteMenu">
      <a href="/" class="w-full h-max block container bg-theme-home max-w-full">
        <h1 class="leading-none">Home</h1>
      </a>
      <div class="w-full grid grid-cols-2">
        <div class="w-full col-span-2 lg:col-span-1">
          <?php snippet('menu/artists') ?>
        </div>
        <div id="secondary-menus" class="w-full col-span-2 lg:col-span-1">
          <?php snippet('menu/essays') ?>
          <?php snippet('menu/recordings') ?>
          <?php snippet('menu/introduction') ?>
          <?php snippet('menu/contact') ?>
          <?php snippet('menu/sponsors') ?>
        </div>
      </div>
    </div>
  </header>
  <main class="relative w-full font-sans selection:bg-zinc-500/50 md:pr-4 md:w-1/2">