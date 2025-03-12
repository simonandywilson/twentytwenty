<?php
$image = $block->image()->toFile();

$alt      = $image->alt()->isNotEmpty() ? $image->alt() : $image->caption();
$caption  = $image->caption();
$src      = $image->url();
$width    = $image->width();
$height   = $image->height();

?>
<?php if ($src) : ?>
  <figure>
    <?php snippet('image', [
      'alt'      => $alt,
      'contain'  => $block->crop()->isFalse(),
      'src'      => $src,
      'ratio'    => $block->ratio()->or('auto'),
      'class'    => "rounded-3xl w-full",
      'width'    => $width,
      'height'   => $height
    ]) ?>
    <?php if ($caption->isNotEmpty()) : ?>
      <figcaption class="figcaption" id="img-caption-<?= $block->id() ?>">
        <?= $caption->kt() ?>
      </figcaption>
    <?php endif ?>
  </figure>
<?php endif ?>