<?php
/*
  Templates render the content of your pages.

  They contain the markup together with some control structures
  like loops or if-statements. The `$page` variable always
  refers to the currently active page.

  To fetch the content from each field we call the field name as a
  method on the `$page` object, e.g. `$page->title()`.

  This default template must not be removed. It is used whenever Kirby
  cannot find a template with the name of the content file.

  Snippets like the header and footer contain markup used in
  multiple templates. They also help to keep templates clean.

  More about templates: https://getkirby.com/docs/guide/templates/basics
*/
?>
<?php snippet('header') ?>

<article>
    <div class="w-full flex">
        <div class="w-full flex-1">
            <h1 class="container bg-theme-artists leading-none"><?= $page->title()->esc() ?></h1>
            <h1 class="container bg-theme-artists leading-none"> <a href="<?= $page->url() ?>"><?= $page->partner()->esc() ?></a></h1>
        </div>
        <div class="w-full flex-1">
            <h1 class="container bg-theme-essays leading-none"><a href="<?= $page->essay() ?>"><?= $page->essay() ?></a></h1>
        </div>
    </div>
    <div class="text">
        <?= $page->text()->kt() ?>
    </div>
</article>

<?php snippet('footer') ?>