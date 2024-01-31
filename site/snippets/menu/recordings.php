<?php
if (!$site->recordings()->isEmpty()) :
?>
    <details class="bg-theme-recordings secondary-details container max-w-full has-[:focus-visible]:ring-2 ring-black">
        <summary class="focus:outline-none">
            <h1 class="leading-none">Recordings</h1>
        </summary>
        <div class="leading-tight mt-[1em] ">
            <?= $site->recordings()->kt() ?>
        </div>
    </details>
<?php endif ?>