<?php
if (!$site->contact()->isEmpty()) :
?>
  <details class="w-full bg-theme-contact rounded-3xl p-3 secondary-details container max-w-full has-[:focus-visible]:ring-2 ring-black -mt-[1px] -ml-[1px]">
    <summary class="focus:outline-none">
      <h2 class="leading-tight">Contact</h1>
    </summary>
    <div class="leading-tight mt-[1em] focus:[&>p>a]:outline-none hover:[&>p>a]:underline focus-visible:[&>p>a]:underline">
      <?= $site->contact()->kt() ?>
    </div>
  </details>
<?php endif ?>