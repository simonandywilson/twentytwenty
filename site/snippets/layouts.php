<section>
  <?php foreach ($field->toBlocks() as $block) : ?>
    <?php
      if ($block->type() === "text") {
        $class = 'text-block';
      } else {
        $class = "";
      }
    ?>
    <div id="<?= $block->id() ?>" class="<?php echo $class; ?>">
      <?= $block ?>
    </div>
  <?php endforeach ?>
  <section>