<img src="<?= esc($src, 'attr') ?>" alt="<?= esc($alt, 'attr') ?>" style="aspect-ratio: <?= $ratio ?? 'auto' ?>; object-fit: <?= ($ratio == "auto") ? 'contain' : 'cover' ?>;"
    class="<?= esc($class, 'attr') ?>"
    loading="<?= isset($lazy) && $lazy === false ? 'eager' : 'lazy' ?>"
    <?= isset($width) ? 'width="' . esc($width, 'attr') . '"' : '' ?>
    <?= isset($height) ? 'height="' . esc($height, 'attr') . '"' : '' ?>>