<?php
if (!$site->accessibility()->isEmpty()) :
?>
    <details class="w-full bg-theme-accessibility rounded-3xl p-3 secondary-details container max-w-full has-[:focus-visible]:ring-2 ring-black -mt-[1px] md:-ml-[1px]">
        <summary class="focus:outline-none">
            <h2 class="leading-tight font-bold">Accessibility</h1>
        </summary>
        <div class="leading-tight mt-[1em] text-focus">
            <?= $site->accessibility()->kt() ?>
        </div>
    </details>
<?php endif ?>




