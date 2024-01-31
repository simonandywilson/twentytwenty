<details open class="w-full h-max bg-theme-artists rounded-2xl p-3 pointer-events-none container max-w-full has-[:focus-visible]:ring-2 ring-black">
    <summary class="focus:outline-none">
        <h1 class="leading-none">Artists</h1>
    </summary>
    <nav class="mt-[1em] pointer-events-auto">
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
                                if ($child->isOpen()) {
                                    $class = 'artist-link block w-max underline';
                                } else {
                                    $class = 'artist-link block w-max hover:underline focus:outline-none focus-visible:underline group';
                                }
                                ?>
                                <?php if ($child->status() == "listed") : ?>
                                    <a class="<?php echo $class; ?>" data-artist-slug="<?= $child->slug() ?>" href="<?= $child->url() ?>">
                                        <h2 class="w-full"><?= $child->title()->html() ?> <span class="relative inline-block w-[0.4rem] h-[0.4rem] top-[0.1rem] -translate-y-1/2 bg-black rounded-full group-focus-visible:bg-white"></span></h2>
                                    </a>
                                <?php endif ?>
                                <?php if ($child->status() == "unlisted") : ?>
                                    <h2 class="artist-link" data-artist-slug="<?= $child->slug() ?>">
                                        <p class="text-black cursor-default"><?= $child->title()->html() ?></p>
                                    </h2>
                                <?php endif ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            <?php endif ?>
        <?php endforeach ?>
    </nav>
</details>