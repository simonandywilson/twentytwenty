<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>
  <?= css([
    'assets/style.css',
    'assets/lightbox.css',
    '@auto'
  ]) ?>
  <!-- <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>"> -->
</head>

<body>
  <header class="fixed pl-4 w-1/2 right-0 grid grid-cols-2 font-sans selection:bg-zinc-500/50">
    <a href="/" class="w-full h-max col-span-2 container bg-theme-home">
      <h1 class="leading-none">Home</h1>
    </a>
    <div class="w-full col-span-1">
      <details open class="w-full h-max bg-theme-artists rounded-2xl p-3 pointer-events-none">
        <summary>
          <h1 class="leading-none">Artists</h1>
        </summary>
        <nav class="mt-[1em] pointer-events-auto">
          <?php foreach ($site->children()->listed() as $item) : ?>
            <?php
            if (in_array($item->id(), ['artists'])) :
            ?>
              <?php
              $children = $item->children()->sortBy('title', 'asc');
              if ($children->isNotEmpty()) :
              ?>
                <ul>
                  <?php foreach ($children as $child) : ?>
                    <li class="leading-tight">
                      <?php
                      if ($child->isOpen()) {
                        $class = 'artist-link block w-max underline';
                      } else {
                        $class = 'artist-link block w-max hover:underline';
                      }
                      ?>
                      <?php if ($child->status() == "listed") : ?>
                        <a class="<?php echo $class; ?>" data-artist-slug="<?= $child->slug() ?>" href="<?= $child->url() ?>">
                          <h2 class="w-max"><?= $child->title()->html() ?> <span class="relative inline-block w-[0.4rem] h-[0.4rem] top-[0.1rem] -translate-y-1/2 bg-black rounded-full"></span></h2>
                        </a>
                      <?php endif ?>
                      <?php if ($child->status() == "unlisted") : ?>
                        <h2 class="artist-link" data-artist-slug="<?= $child->slug() ?>">
                          <p class="text-black cursor-default"><?= $child->title()->html() ?></p>
                        </h2>
                      <?php endif ?>
                    </li>
                  <?php endforeach ?>
                </ul>
              <?php endif ?>
            <?php endif ?>
          <?php endforeach ?>
        </nav>
      </details>
    </div>
    <div id="secondary-menus" class="w-full col-span-1">
      <details open class="bg-theme-essays rounded-2xl p-3 secondary-details">
        <summary>
          <h1 class="leading-none">Essays</h1>
        </summary>
        <nav class="mt-[1em]">
          <?php foreach ($site->children()->listed() as $item) : ?>
            <?php
            if (in_array($item->id(), ['artists'])) :
            ?>
              <?php
              $children = $item->children()->sortBy('title', 'asc');
              if ($children->isNotEmpty()) :
              ?>
                <ul>
                  <?php foreach ($children as $child) : ?>
                    <li class="leading-tight">
                      <?php
                      if ($child->essay()->toPage()->isOpen()) {
                        $class = 'artist-link block w-full underline';
                      } else {
                        $class = 'artist-link block w-full hover:underline';
                      }
                      ?>
                      <?php if ($child->status() == "listed") : ?>
                        <a class="<?php echo $class; ?>" data-artist-slug="<?= $child->slug() ?>" href="<?= $child->essay()->toPage()->url() ?>">
                          <h2><?= $child->essay()->toPage()->title()->html() ?></h2>
                        </a>
                      <?php endif ?>
                    </li>
                  <?php endforeach ?>
                </ul>
              <?php endif ?>
            <?php endif ?>
          <?php endforeach ?>
        </nav>
      </details>
      <details class="bg-theme-recordings rounded-2xl secondary-details">
        <summary class="p-3">
          <h1 class="leading-none">Recordings</h1>
        </summary>
        <div class="leading-tight px-3 pb-3">
          <?= $site->recordings()->kt() ?>
        </div>
      </details>
      <details class="bg-theme-introduction rounded-2xl secondary-details">
        <summary class="p-3">
          <h1 class="leading-none">Introduction</h1>
        </summary>
        <div class="leading-tight px-3 pb-3">
          <?= $site->introduction()->kt() ?>
        </div>
      </details>
      <details class="bg-theme-contact rounded-2xl secondary-details">
        <summary class="p-3">
          <h1 class="leading-none">Contact</h1>
        </summary>
        <div class="leading-tight px-3 pb-3">
          <?= $site->contact()->kt() ?>
        </div>
      </details>
      <details open class="bg-theme-sponsors rounded-2xl p-3 secondary-details">
        <summary>
          <h1 class="leading-none">Sponsors</h1>
        </summary>
        <nav class="mt-[1em]">
        <?php snippet('sponsors') ?>

        </nav>
      </details>
    </div>
  </header>
  <main class="relative w-1/2 font-sans selection:bg-zinc-500/50 pr-4">