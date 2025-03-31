

<?php snippet('header') ?>
<h1 class="sr-only"><a href="#" autofocus id="main-content">Main Content</a></h1>
<article>
    <div class="w-full grid grid-cols-1 md:grid-cols-2">
        <h3 class="container bg-theme-essays leading-tight has-[:focus-visible]:ring-2 ring-black max-md:-mt-[1px]">
            <span class="leading-tight font-bold">Accessibility Statement</span>
        </h3>
    </div>
    <section class="text-block accessibility">
    <?= $site->accessibilitystatement()->kirbytext()->toBlocks() ?>
</section>
</article>
<div class="fixed w-screen h-screen inset-0 top-0 -z-10 bg-zinc-500"> </div>
<?php snippet('footer') ?>