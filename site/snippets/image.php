<img src="<?= esc($src, 'attr') ?>" alt="<?= esc($alt, 'attr') ?>" style="
      aspect-ratio: <?= $ratio ?? 'auto' ?>;
      object-fit: <?= ($ratio == "auto") ? 'contain' : 'cover' ?>
    "
    class="<?= esc($class, 'attr') ?>">