<?php
if (!$site->contact()->isEmpty()) :
?>
  <details class="w-full bg-theme-contact rounded-2xl p-3 secondary-details container max-w-full has-[:focus-visible]:ring-2 ring-black">
    <summary class="focus:outline-none">
      <h1 class="leading-none">Contact</h1>
    </summary>
    <div class="leading-tight mt-[1em] hover:[&>p>a]:underline">
      <?= $site->contact()->kt() ?>
    </div>
  </details>
<?php endif ?>