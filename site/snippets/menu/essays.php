<details open class="w-full bg-theme-essays rounded-3xl p-3 secondary-details container max-w-full has-[:focus-visible]:ring-2 ring-black -mt-[1px] md:-ml-[1px]">
    <summary class="focus:outline-none">
        <h2 class="leading-tight">Essays</h2>
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
                                    <?php if ($child->status() == "listed") : ?>
                                        <a class="artist-link block w-full hover:underline focus:outline-none focus-visible:underline group" 
                                           data-artist-slug="<?= $child->slug() ?>" 
                                           href="<?= $child->essay()->toPage()->url() ?>"
                                           <?php if ($child->essay()->toPage()->isOpen()) : ?>
                                           aria-current="page"
                                           <?php endif ?>>
                                            <h3><?= $child->essay()->toPage()->title()->html() ?>
                                                <?php if ($child->essay()->toPage()->isOpen()) : ?>
                                                    <span class="relative inline-block w-[0.4rem] h-[0.4rem] top-[0.1rem] -translate-y-1/2 bg-black rounded-full" 
                                                          aria-hidden="true"></span>
                                                <?php endif ?>
                                            </h3>
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