

<?php snippet('header') ?>
<h1 class="sr-only">Main Content</h1>
<article>
    <div class="w-full grid grid-cols-1 md:grid-cols-2">
        <h3 autofocus class="container bg-theme-essays leading-tight has-[:focus-visible]:ring-2 ring-black max-md:-mt-[1px]">
            <span class="leading-tight">Accessibility Statement</span>
        </h3>
    </div>
    <section class="text-block accessibility">
    <?= $site->accessibility()->kirbytext()->toBlocks() ?>
</section>
</article>
<div class="fixed w-screen h-screen inset-0 top-0 -z-10 bg-zinc-500"> </div>
<?php snippet('footer') ?>