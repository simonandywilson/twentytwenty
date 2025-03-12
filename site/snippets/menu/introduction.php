<?php
if (!$site->introduction()->isEmpty()) :
?>
    <details class="w-full bg-theme-introduction rounded-3xl p-3 secondary-details container max-w-full has-[:focus-visible]:ring-2 ring-black -mt-[1px] md:-ml-[1px]">
        <summary class="focus:outline-none">
            <h2 class="leading-tight">Introduction</h1>
        </summary>
        <div class="mt-[1em] leading-tight">
            <?= $site->introduction()->kt() ?>
        </div>
    </details>
<?php endif ?>