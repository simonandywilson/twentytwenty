<?php
/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  This header snippet is reused in all templates.
  It fetches information from the `site.txt` content file
  and contains the site navigation.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <?php
  /*
    In the title tag we show the title of our
    site and the title of the current page
  */
  ?>
  <title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>

  <?php
  /*
    Stylesheets can be included using the `css()` helper.
    Kirby also provides the `js()` helper to include script file.
    More Kirby helpers: https://getkirby.com/docs/reference/templates/helpers
  */
  ?>
    <?= css([
    'assets/style.css',
    'assets/lightbox.css',
    '@auto'
  ]) ?>
  <?php
  /*
    The `url()` helper is a great way to create reliable
    absolute URLs in Kirby that always start with the
    base URL of your site.
  */
  ?>
  <!-- <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>"> -->
</head>

<body>

  <header class="fixed w-1/2 right-0 grid grid-cols-2 font-sans selection:bg-zinc-500/50">
    <a href="/" class="w-full h-max col-span-2 container bg-orange-500">
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
                          <h2 class="w-max"><?= $child->title()->html() ?></h2>
                        </a>
                      <?php endif ?>
                      <?php if ($child->status() == "unlisted") : ?>
                        <h2 class="artist-link" data-artist-slug="<?= $child->slug() ?>">
                          <p class="text-white cursor-default"><?= $child->title()->html() ?></p>
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
                        $class = 'artist-link block w-max underline';
                      } else {
                        $class = 'artist-link block w-max hover:underline';
                      }
                      ?>
                      <?php if ($child->status() == "listed") : ?>
                        <a class="<?php echo $class; ?>" data-artist-slug="<?= $child->slug() ?>" href="<?= $child->essay()->toPage()->url() ?>">
                          <h2><?= $child->essay()->toPage()->title()->html() ?></h2>
                        </a>
                      <?php endif ?>
                      <?php if ($child->status() == "unlisted") : ?>
                        <h2 class="artist-link" data-artist-slug="<?= $child->slug() ?>">
                          <p class="text-white cursor-default"><?= $child->essay()->toPage()->title()->html() ?></p>
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
      <details open class="bg-theme-introduction rounded-2xl p-3 secondary-details">
        <summary>
          <h1 class="leading-none">Introduction</h1>
        </summary>
        <div class="mt-[1em] leading-tight">
          <?= $site->introduction()->kt() ?>
        </div>
      </details>
      <details class="bg-theme-contact rounded-2xl p-3 secondary-details">
        <summary>
          <h1 class="leading-none">Contact</h1>
        </summary>
        <div class="mt-[1em]">
          <p>Contact</p>
        </div>
      </details>
    </div>
  </header>

  <main class="relative w-1/2 font-sans selection:bg-zinc-500/50">