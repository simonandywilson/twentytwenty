<?php snippet('header') ?>
<h1 class="sr-only"><a href="#" autofocus id="main-content">Main Content</a></h1>
<article id="main-content">
    <div class="w-full grid grid-cols-1 lg:grid-cols-2">
        <?php
            if ($page->artist()->isNotEmpty()):
                ?>
            <a href="<?= $page->artist()->toPage()->url() ?>" class="container bg-theme-essays leading-tight has-[:focus-visible]:ring-2 ring-black max-md:-mt-[1px]">
                <h3 class="leading-tight"><?= $page->artist()->toPage()->title()->html() ?> <span aria-hidden="true">→</span></h3>
            </a>
            <?php else: ?>
            <div class="w-full h-full"></div>
        <?php endif ?>

        <?php
            if ($page->title()->html()):
                ?>
            <h2 class="container bg-theme-essays leading-tight max-lg:-mt-[1px] has-[:focus-visible]:ring-2 ring-black md:-ml-[1px]">
                <span class="leading-tight font-bold"><?= $page->title()->html() ?></span>
            </h2>
            <?php else: ?>
            <div class="w-full h-full"></div>
        <?php endif ?>
        <div class="w-full h-full"></div>



        <div class="w-full flex-1 -mt-[1px]">
            <?php if ($page->author()->isNotEmpty()) : ?>
                <h3 class="container bg-theme-essays leading-tight"><?= $page->author()->html() ?></h3>
            <?php endif ?>
            <?php if ($page->pdf()) : ?>
                <a class="block w-full container bg-theme-essays leading-tight -mt-[1px] has-[:focus-visible]:ring-2 ring-black" href="<?= $page->pdf()->toFile()->url() ?>" download aria-label="Download PDF of <?= $page->title()->html() ?>">Download PDF</a>
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