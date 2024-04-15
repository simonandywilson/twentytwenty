<?php
if (!$site->introduction()->isEmpty()) :
?>
    <details class="w-full bg-theme-introduction rounded-2xl p-3 secondary-details container max-w-full has-[:focus-visible]:ring-2 ring-black">
        <summary class="focus:outline-none">
            <h1 class="leading-none">Introduction</h1>
        </summary>
        <div class="mt-[1em] leading-tight">
            <?= $site->introduction()->kt() ?>
        </div>
    </details>
<?php endif ?>