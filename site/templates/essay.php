<?php snippet('header') ?>
<article>
    <div class="w-full grid grid-cols-2">
        <div class="w-full flex-1">
            <?php if ($page->artist()->isNotEmpty()) : ?>
                <a href="<?= $page->artist()->toPage()->url() ?>" class="group focus:outline-none">
                    <h2 class="container bg-theme-artists leading-none group-focus-visible:ring-2 ring-black">→ <?= $page->artist()->toPage()->title()->html() ?></h2>
                </a>
            <?php endif ?>
        </div>
        <div class="w-full flex-1">
            <h1 class="container bg-theme-essays leading-tight"><?= $page->title()->html() ?></h1>
            <?php if ($page->author()->isNotEmpty()) : ?>
                <h2 class="container bg-theme-essays leading-tight"><?= $page->author()->html() ?></h2>
            <?php endif ?>
            <?php if ($page->pdf()) : ?>
                <a class="block w-full container bg-theme-essays leading-tight" href="<?= $page->pdf()->toFile()->url() ?>" download>Download PDF</a>
            <?php endif ?>
        </div>
    </div>
    <?php snippet('layouts', ['field' => $page->text()])  ?>
</article>
<div class="fixed w-screen h-screen inset-0 top-0 -z-10">
    <div class="absolute w-[150vw] h-[150vh] -left-[25vw] -top-[25vh] inset-0 z-50 backdrop-blur-xl"></div>
    <img class="w-full h-full object-cover" src="<?= $page->cover()->toFile()->resize($width = 500)->url() ?>" alt="<?= $page->cover()->toFile()->alt()->esc() ?>">
</div>
<?php snippet('footer') ?>