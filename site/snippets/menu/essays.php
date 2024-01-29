<details open class="w-full bg-theme-essays rounded-2xl p-3 secondary-details container">
    <summary>
        <h1 class="leading-none">Essays</h1>
    </summary>
    <nav class="mt-[1em]">
        <?php foreach ($site->children()->listed() as $item) : ?>
            <?php
            if (in_array($item->id(), ['artists'])) :
            ?>
                <?php
                $children = $item->children()->sortBy('title', 'asc');
                if ($children->isNotEmpty()) :
                ?>
                    <ul>
                        <?php foreach ($children as $child) : ?>
                            <li class="leading-tight">
                                <?php
                                if ($child->essay()->toPage()->isOpen()) {
                                    $class = 'artist-link block w-full underline';
                                } else {
                                    $class = 'artist-link block w-full hover:underline';
                                }
                                ?>
                                <?php if ($child->status() == "listed") : ?>
                                    <a class="<?php echo $class; ?>" data-artist-slug="<?= $child->slug() ?>" href="<?= $child->essay()->toPage()->url() ?>">
                                        <h2><?= $child->essay()->toPage()->title()->html() ?></h2>
                                    </a>
                                <?php endif ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            <?php endif ?>
        <?php endforeach ?>
    </nav>
</details>