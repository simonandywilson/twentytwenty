<?php
$image = $block->image()->toFile();

$alt      = $image->alt();
$caption  = $image->caption();
$src      = $image->url();

?>
<?php if ($src) : ?>
  <figure>
    <?php snippet('image', [
      'alt'      => $alt,
      'contain'  => $block->crop()->isFalse(),
      'src'      => $src,
      'ratio'    => $block->ratio()->or('auto'),
      'class'    => "rounded-3xl w-full"
    ]) ?>
    <?php if ($caption->isNotEmpty()) : ?>
      <figcaption class="figcaption">
        <?= $caption->kt() ?>
      </figcaption>
    <?php endif ?>
  </figure>
<?php endif ?>