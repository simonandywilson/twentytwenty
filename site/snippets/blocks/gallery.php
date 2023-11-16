<?php
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$ratio   = $block->ratio()->or('auto');
?>
<figure<?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?>>
  <ul class="grid grid-cols-2">
    <?php foreach ($block->images()->toFiles() as $image) : ?>
      <li>
        
        <figure>
          <img src="<?= $image->url() ?>" alt="<?= $image->alt() ?>" class="round">
          <?php if ($image->caption()->isNotEmpty()) : ?>
            <figcaption>
            <?= $image->caption() ?>
            </figcaption>
          <?php endif ?>
        </figure>
      </li>
    <?php endforeach ?>
  </ul>
  <?php if ($caption->isNotEmpty()) : ?>
    <figcaption>
      <?= $caption ?>
    </figcaption>
  <?php endif ?>
  </figure>