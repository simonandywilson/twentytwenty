<?php
if (!$site->contact()->isEmpty()) :
?>
  <details class="bg-theme-contact secondary-details container max-w-full has-[:focus-visible]:ring-2 ring-black">
    <summary class="focus:outline-none">
      <h1 class="leading-none">Contact</h1>
    </summary>
    <div class="leading-tight mt-[1em] ">
      <?= $site->contact()->kt() ?>
    </div>
  </details>
<?php endif ?>