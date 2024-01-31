<?php
if (!$site->introduction()->isEmpty()) :
?>
    <details class="bg-theme-introduction secondary-details container max-w-full has-[:focus-visible]:ring-2 ring-black">
        <summary class="focus:outline-none">
            <h1 class="leading-none">Introduction</h1>
        </summary>
        <div class="mt-[1em] leading-tight">
            <?= $site->introduction()->kt() ?>
        </div>
    </details>
<?php endif ?>