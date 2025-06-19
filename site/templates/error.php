<?php snippet('header') ?>
<article id="main-content">
    <div class="w-full grid grid-cols-1 lg:grid-cols-2">
        <h2 class="container bg-theme-artists leading-tight max-md:-mt-[1px]">
            <span class="leading-tight font-bold">Page Not Found</span>
        </h2>
    </div>
    <div class="container w-full h-full -mt-[1px] text-focus">
        <p>We're sorry, but the page you were looking for could not be found.</p>
        <p>You could try heading back to the <a href="<?= site()->url() ?>">homepage</a>.</p>
    </div>
</article>

<?php snippet('footer') ?>