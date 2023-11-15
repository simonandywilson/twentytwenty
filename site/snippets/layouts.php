<section>
  <?php foreach ($field->toBlocks() as $block) : ?>
    <div id="<?= $block->id() ?>" class="block-type-<?= $block->type() ?> leading-tight">
      <?= $block ?>
    </div>
  <?php endforeach ?>
  <section>