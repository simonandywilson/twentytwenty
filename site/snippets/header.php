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
  <title><?= $site->title()->esc() ?> | <?= $page->title()->esc() ?></title>

  <?php
  /*
    Stylesheets can be included using the `css()` helper.
    Kirby also provides the `js()` helper to include script file.
    More Kirby helpers: https://getkirby.com/docs/reference/templates/helpers
  */
  ?>
  <?= css(['assets/style.css', '@auto']) ?>

  <?php
  /*
    The `url()` helper is a great way to create reliable
    absolute URLs in Kirby that always start with the
    base URL of your site.
  */
  ?>
  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">
</head>

<body>

  <header class="fixed w-1/2 right-0 flex flex-row">
    <?php
    /*
      <a class="logo" href="<?= $site->url() ?>">
      <?= $site->title()->esc() ?>
    </a>
    */
    ?>


    <div class="w-1/2 h-max bg-theme-artists rounded-2xl p-3">

      <h1>Artists</h1>
      <nav>

        <?php foreach ($site->children()->listed() as $item) : ?>
          <?php
          if (in_array($item->id(), ['artists'])) :
          ?>
            <?php
            $children = $item->children()->listed();
            if ($children->isNotEmpty()) :
            ?>
              <ul>
                <?php foreach ($children as $child) : ?>
                  <li class="leading-none">
                    <a <?php e($child->isOpen(), 'class="underline"') ?> href="<?= $child->url() ?>"><?= $child->title()->html() ?></a>
                  </li>
                <?php endforeach ?>
              </ul>
            <?php endif ?>

          <?php endif ?>
        <?php endforeach ?>
      </nav>
    </div>
    <div id="secondary-menus" class="w-1/2">
      <details open class="bg-theme-essays rounded-2xl p-3">
        <summary>
          <h1>Essays</h1>
        </summary>
        <nav>
          <?php foreach ($site->children()->listed() as $item) : ?>
            <?php
            if (in_array($item->id(), ['essays'])) :
            ?>
              <?php
              $children = $item->children()->listed();
              if ($children->isNotEmpty()) :
              ?>
                <ul>
                  <?php foreach ($children as $child) : ?>
                    <li class="leading-none">
                      <a <?php e($child->isOpen(), 'class="underline"') ?> href="<?= $child->url() ?>"><?= $child->title()->html() ?></a>
                    </li>
                  <?php endforeach ?>
                </ul>
              <?php endif ?>

            <?php endif ?>
          <?php endforeach ?>
        </nav>
      </details>
      <details class="bg-theme-introduction rounded-2xl p-3">
        <summary>
          <h1>Introduction</h1>
        </summary>
        <div class="mt-[1em]">
          <?= $site->introduction()->kt() ?>
        </div>
      </details>
      <details class="bg-theme-contact rounded-2xl p-3">
        <summary>
          <h1>Contact</h1>
        </summary>
        <div class="mt-[1em]">
          <p>Contact</p>
        </div>
      </details>
    </div>
  </header>

  <main class="relative w-1/2">