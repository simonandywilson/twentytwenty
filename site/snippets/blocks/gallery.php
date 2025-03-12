<?php
$caption = $block->caption();
?>
<figure>
  <ul class="grid grid-cols-2" role="list" aria-label="Image gallery">
    <?php $counter = 0; ?>
    <?php foreach ($block->images()->toFiles() as $image) : ?>
      <li>
        <figure>
          <?php 
            $alt = $image->alt()->isNotEmpty() ? $image->alt() : $image->caption();
            $imgId = 'gallery-img-' . $block->id() . '-' . $counter;
            $captionId = 'gallery-caption-' . $block->id() . '-' . $counter;
          ?>
          <?php snippet('image', [
            'alt'      => $alt,
            'contain'  => $block->crop()->isTrue(),
            'ratio'    => $block->ratio()->or('auto'),
            'src'      => $image->url(),
            'class'    => "rounded-3xl",
            'width'    => $image->width(),
            'height'   => $image->height(),
            'id'       => $imgId
          ]) ?>
          <?php if ($image->caption()->isNotEmpty()) : ?>
            <figcaption class="figcaption <?= ($counter % 2 === 0) ? '' : '-ml-[1px]' ?>" id="<?= $captionId ?>">
              <?= $image->caption() ?>
            </figcaption>
          <?php endif ?>
        </figure>
      </li>
      <?php $counter++; ?>
    <?php endforeach ?>
  </ul>
  <?php if ($caption->isNotEmpty()) : ?>
    <figcaption class="figcaption" id="gallery-caption-<?= $block->id() ?>">
      <?= $caption ?>
    </figcaption>
  <?php endif ?>
</figure>