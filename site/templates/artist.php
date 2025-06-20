<?php snippet('header') ?>
<article id="main-content">
    <div class="w-full grid grid-cols-1 lg:grid-cols-2">
        <h2 class="container bg-theme-artists leading-tight max-md:-mt-[1px]">
            <span class="leading-tight font-bold"><?= $page->title()->html() ?></span>
        </h2>
        
        <?php
            if ($page->essay()->toPage()):
                ?>
            <a href="<?= $page->essay()->toPage()->url() ?>" class="container bg-theme-essays leading-tight has-[:focus-visible]:ring-2 ring-black max-lg:-mt-[1px] lg:-ml-[1px]">
                <h3 class="leading-tight"><?= $page->essay()->toPage()->title()->html() ?> <span aria-hidden="true">→</span></h3>
            </a>
            <?php else: ?>
            <div class="w-full h-full"></div>
        <?php endif ?>
        <?php
            if ($page->partnername()->exists()):
                ?>
            <a href="<?= $page->partnerurl() ?>" class="container bg-theme-essays leading-tight has-[:focus-visible]:ring-2 ring-black -mt-[1px]">
                <h3 class="leading-tight"><?= $page->partnername() ?> <span aria-hidden="true">→</span></h3>
            </a>
            <?php else: ?>
            <div class="w-full h-full"></div>
        <?php endif ?>
        <?php
            if ($page->partnerreflection()->exists() && $page->partnerreflection()->isNotEmpty()):
                ?>
            <a href="#partner-reflection" class="container bg-theme-essays leading-tight has-[:focus-visible]:ring-2 ring-black -mt-[1px] lg:-ml-[1px]">
                <h3 class="leading-tight">Partner Reflection <span aria-hidden="true">↓</span></h3>
            </a>
            <?php else: ?>
            <div class="w-full h-full"></div>
        <?php endif ?>

    </div>
    <?php snippet("layouts", ["field" => $page->text()]) ?>
    <?php
        if ($page->partnerreflection()->exists() && $page->partnerreflection()->isNotEmpty()):
            ?>
        <div class="w-full h-full mt-8">
            <h3 class="container bg-theme-essays leading-tight" id="partner-reflection">Partner Reflection</h3>
            <?php snippet("layouts", ["field" => $page->partnerreflection()]) ?>
        </div>
    <?php endif ?>
</article>
<div class="fixed w-screen h-screen inset-0 top-0 -z-10">
    <div class="absolute w-[150vw] h-[150vh] -left-[25vw] -top-[25vh] inset-0 z-50 backdrop-blur-xl"></div>
    <img class="w-full h-full object-cover" src="<?= $page->cover()->toFile()->resize($width = 500)->url() ?>"
        alt="<?= $page->cover()->toFile()->alt()->esc() ?>">
</div>
<?php snippet('footer') ?>