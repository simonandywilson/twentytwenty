<details open class="w-full h-max bg-theme-artists rounded-3xl p-3 pointer-events-none container max-w-full has-[:focus-visible]:ring-2 ring-black -mt-[1px]">
    <summary class="focus:outline-none">
        <h1 class="leading-tight">Artists</h1>
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
                                $hasContent = $child->hasChildren() || $child->text()->isNotEmpty();
                                ?>
                                    <a class="artist-link block w-max <?= $hasContent ? 'hover:underline' : 'opacity-50' ?> focus:outline-none focus-visible:underline group" 
                                       data-artist-slug="<?= $child->slug() ?>" 
                                       <?= $hasContent ? 'href="' . $child->url() . '"' : '' ?>>
                                        <h2 class="w-full"><?= $child->title()->html() ?>
                                            <?php if ($child->isOpen()) : ?>
                                                <span class="relative inline-block w-[0.4rem] h-[0.4rem] top-[0.1rem] -translate-y-1/2 bg-black rounded-full group-focus-visible:bg-white"></span>
                                            <?php endif ?>
                                        </h2>
                                    </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            <?php endif ?>
        <?php endforeach ?>
    </nav>
</details>