<?php
$caption = $block->caption();
?>
<figure>
  <ul class="grid grid-cols-2">
    <?php foreach ($block->images()->toFiles() as $image) : ?>
      <li>
        <figure>
          <?php snippet('image', [
            'alt'      => $image->alt(),
            'contain'  => $block->crop()->isTrue(),
            'ratio'    => $block->ratio()->or('auto'),
            'src'      => $image->url(),
            "class"    => "rounded-3xl"
          ]) ?>
          <?php if ($image->caption()->isNotEmpty()) : ?>
            <figcaption class="figcaption">
              <?= $image->caption() ?>
            </figcaption>
          <?php endif ?>
        </figure>
      </li>
    <?php endforeach ?>
  </ul>
  <?php if ($caption->isNotEmpty()) : ?>
    <figcaption class="figcaption">
      <?= $caption ?>
    </figcaption>
  <?php endif ?>
</figure>