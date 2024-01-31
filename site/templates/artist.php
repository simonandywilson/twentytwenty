<?php snippet('header') ?>
<article>
    <div class="w-full grid grid-cols-1 lg:grid-cols-2">
        <div class="w-full flex-1">
            <h1 class="container bg-theme-artists leading-none"><?= $page->title()->html() ?></h1>
            <?php
            if ($page->partnername()->exists()) :
            ?>
                <a href="<?= $page->partnerurl() ?>" class="container block w-full flex-1 h-max bg-theme-artists">
                    <h2 class="leading-tight">
                        → <?= $page->partnername() ?>
                    </h2>
                </a>
            <?php endif ?>
        </div>
        <?php
        if ($page->essay()->toPage()) :
        ?>
            <a href="<?= $page->essay()->toPage()->url() ?>" class="container w-full flex-1 h-max bg-theme-essays">
                <h3 class="leading-tight">→ <?= $page->essay()->toPage()->title()->html() ?></h3>
            </a>
        <?php endif ?>
    </div>
    <?php snippet("layouts", ["field" => $page->text()])  ?>
</article>
<div class="fixed w-screen h-screen inset-0 top-0 -z-10">
    <div class="absolute w-[150vw] h-[150vh] -left-[25vw] -top-[25vh] inset-0 z-50 backdrop-blur-xl"></div>
    <img class="w-full h-full object-cover" src="<?= $page->cover()->toFile()->resize($width = 500)->url() ?>" alt="<?= $page->cover()->toFile()->alt()->esc() ?>">
</div>
<?php snippet('footer') ?>