<section>
  <?php foreach ($field->toBlocks() as $block) : ?>
    <?php
      if ($block->type() === "text") {
        $class = 'text-block';
      } else if ($block->type() === "list") {
        $class = 'text-block [&_ul]:list-disc pl-6 ';
      } else {
        $class = "";
      }
    ?>
    <div id="<?= $block->id() ?>" class="<?php echo $class; ?>">
      <?= $block ?>
    </div>
  <?php endforeach ?>
</section>