<details open class="w-full bg-theme-essays rounded-2xl p-3 secondary-details container max-w-full has-[:focus-visible]:ring-2 ring-black">
    <summary class="focus:outline-none">
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
                            <?php
                                if ($child->essay()->toPage()) :
                            ?>
                                <li class="leading-tight">
                                    <?php
                                    if ($child->essay()->toPage()->isOpen()) {
                                        $class = 'artist-link block w-full underline group focus:outline-none';
                                    } else {
                                        $class = 'artist-link block w-full hover:underline focus:outline-none focus-visible:underline group';
                                    }
                                    ?>
                                    <?php if ($child->status() == "listed") : ?>
                                        <a class="<?php echo $class; ?>" data-artist-slug="<?= $child->slug() ?>" href="<?= $child->essay()->toPage()->url() ?>">
                                            <h2><?= $child->essay()->toPage()->title()->html() ?> </h2>
                                        </a>
                                    <?php endif ?>
                                </li>
                            <?php endif ?>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            <?php endif ?>
        <?php endforeach ?>
    </nav>
</details>