<?php snippet('header') ?>
<h1 class="sr-only"><a href="#" autofocus id="main-content">Main Content</a></h1>
<div class="relative w-full h-screen flex flex-col gap-[3vw]" tabindex="-1">
  <div class="relative max-h-[calc(50vh-1.5vw)]">
    <svg xmlns="http://www.w3.org/2000/svg" width="1000" height="578.5988" viewBox="0 0 1000 578.5988" class="w-full h-full object-contain" preserveAspectRatio="xMaxYMin meet" role="img" aria-label="Decorative number 2">
      <path d="M16.26 205.102C10.567 87.963 79.715 0.93 201.719 0.93c100.871 0 180.586 58.581 180.586 165.95 0 101.668 -68.32 152.931 -139.92 197.682 -72.397 43.914 -148.035 80.503 -161.874 152.103h296.093v61.002H0c11.363 -136.64 80.511 -185.451 161.85 -235.895 97.63 -60.206 147.238 -96.006 147.238 -175.721 0 -62.627 -50.436 -104.12 -111.438 -104.12 -80.543 0 -114.687 74.053 -112.234 143.161h-69.156Z" />
    </svg>
    <div class="absolute w-full h-full top-0 right-0 flex justify-end">
      <div class="relative h-full aspect-square rounded-full overflow-hidden ">
        <?php foreach ($site->children()->listed() as $item) : ?>
          <?php
          if (in_array($item->id(), ['artists'])) :
          ?>
            <?php
            $children = $item->children()->sortBy('status', 'asc');
            if ($children->isNotEmpty()) :
            ?>
              <?php foreach ($children as $child) : ?>
                <?php
                $index = $child->indexOf($children);
                ?>
                <div class="artist-circle opacity-0" data-artist-slug="<?= $child->slug() ?>">
                  <?php if ($child->circleone()->isNotEmpty() && $child->status() == "listed") : ?>
                    <img class="artist-circle-img" src="<?= $child->circleone()->toFile()->resize($width = 750)->url() ?>" alt="<?= $child->title()->esc() ?> - Circle Image 1">
                  <?php else : ?>
                    <div class="w-full h-full">
                      <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" width="1000" height="1000" viewBox="0 0 1000 1000.014" role="img" aria-hidden="true">
                        <path d="M500 119.974c209.543 0 380.026 170.469 380.026 380.026S709.543 880.026 500 880.026 119.974 709.543 119.974 500 290.443 119.974 500 119.974M500 0C224.289 0 0 224.289 0 500s224.289 500.014 500 500.014S1000 775.711 1000 500 775.711 0 500 0" />
                      </svg>
                    </div>
                  <?php endif ?>
                </div>
              <?php endforeach ?>
              <div class="artist-circle-default">
                <div class="w-full h-full">
                      <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" width="1000" height="1000" viewBox="0 0 1000 1000.014" role="img" aria-hidden="true">
                        <path d="M500 119.974c209.543 0 380.026 170.469 380.026 380.026S709.543 880.026 500 880.026 119.974 709.543 119.974 500 290.443 119.974 500 119.974M500 0C224.289 0 0 224.289 0 500s224.289 500.014 500 500.014S1000 775.711 1000 500 775.711 0 500 0" />
                      </svg>
                    </div>
              </div>
            <?php endif ?>
          <?php endif ?>
        <?php endforeach ?>
      </div>
    </div>
  </div>
  <div class="relative max-h-[calc(50vh-1.5vw)]">
    <svg xmlns="http://www.w3.org/2000/svg" width="1000" height="578.5988" viewBox="0 0 1000 578.5988" class="w-full h-full object-contain" preserveAspectRatio="xMaxYMin meet" role="img" aria-label="Decorative number 0">
      <path d="M16.26 205.102C10.567 87.963 79.715 0.93 201.719 0.93c100.871 0 180.586 58.581 180.586 165.95 0 101.668 -68.32 152.931 -139.92 197.682 -72.397 43.914 -148.035 80.503 -161.874 152.103h296.093v61.002H0c11.363 -136.64 80.511 -185.451 161.85 -235.895 97.63 -60.206 147.238 -96.006 147.238 -175.721 0 -62.627 -50.436 -104.12 -111.438 -104.12 -80.543 0 -114.687 74.053 -112.234 143.161h-69.156Z" />
    </svg>
    <div class="absolute w-full h-full top-0 right-0 flex justify-end">
      <div class="relative h-full aspect-square rounded-full overflow-hidden ">
        <?php foreach ($site->children()->listed() as $item) : ?>
          <?php
          if (in_array($item->id(), ['artists'])) :
          ?>
            <?php
            $children = $item->children()->sortBy('status', 'asc');
            if ($children->isNotEmpty()) :
            ?>
              <?php foreach ($children as $child) : ?>
                <?php
                $index = $child->indexOf($children);
                ?>
                <div class="artist-circle opacity-0" data-artist-slug="<?= $child->slug() ?>">
                  <?php if ($child->circletwo()->isNotEmpty() && $child->status() == "listed") : ?>
                    <img class="artist-circle-img" src="<?= $child->circletwo()->toFile()->resize($width = 750)->url() ?>" alt="<?= $child->title()->esc() ?> - Circle Image 2">
                  <?php else : ?>
                    <div class="w-full h-full">
                      <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" width="1000" height="1000" viewBox="0 0 1000 1000.014" role="img" aria-hidden="true">
                        <path d="M500 119.974c209.543 0 380.026 170.469 380.026 380.026S709.543 880.026 500 880.026 119.974 709.543 119.974 500 290.443 119.974 500 119.974M500 0C224.289 0 0 224.289 0 500s224.289 500.014 500 500.014S1000 775.711 1000 500 775.711 0 500 0" />
                      </svg>
                    </div>
                  <?php endif ?>
                </div>
              <?php endforeach ?>
              <div class="artist-circle-default">
                <div class="w-full h-full">
                      <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" width="1000" height="1000" viewBox="0 0 1000 1000.014" role="img" aria-hidden="true">
                        <path d="M500 119.974c209.543 0 380.026 170.469 380.026 380.026S709.543 880.026 500 880.026 119.974 709.543 119.974 500 290.443 119.974 500 119.974M500 0C224.289 0 0 224.289 0 500s224.289 500.014 500 500.014S1000 775.711 1000 500 775.711 0 500 0" />
                      </svg>
                    </div>
              </div>
            <?php endif ?>
          <?php endif ?>
        <?php endforeach ?>
      </div>
    </div>
  </div>
  <!-- <div class="absolute w-full h-auto fill-red-500 top-0 left-0">
    <svg class="w-full h-auto object-contain" xmlns="http://www.w3.org/2000/svg" width="1000" height="1218.145" viewBox="0 0 1000 1218.145">
      <path d="M710.705 0c-159.524 0 -289.295 129.772 -289.295 289.295s129.772 289.303 289.295 289.303 289.295 -129.78 289.295 -289.303S870.228 0 710.705 0" stroke-width="0" />
      <path d="M16.26 205.102C10.567 87.963 79.715 0.93 201.719 0.93c100.871 0 180.586 58.581 180.586 165.95 0 101.668 -68.32 152.931 -139.92 197.682 -72.397 43.914 -148.035 80.503 -161.874 152.103h296.093v61.002H0c11.363 -136.64 80.511 -185.451 161.85 -235.895 97.63 -60.206 147.238 -96.006 147.238 -175.721 0 -62.627 -50.436 -104.12 -111.438 -104.12 -80.543 0 -114.687 74.053 -112.234 143.161h-69.156Z" stroke-width="0" />
      <path d="M710.705 639.546c-159.524 0 -289.295 129.772 -289.295 289.295s129.772 289.303 289.295 289.303 289.295 -129.78 289.295 -289.303 -129.772 -289.295 -289.295 -289.295" stroke-width="0" />
      <path d="M16.26 844.64c-5.701 -117.131 63.455 -204.164 185.451 -204.164 100.871 0 180.586 58.581 180.586 165.95 0 101.668 -68.32 152.931 -139.92 197.674 -72.397 43.914 -148.035 80.511 -161.874 152.111h296.093v60.994H0c11.363 -136.64 80.511 -185.459 161.85 -235.895 97.63 -60.206 147.238 -96.006 147.238 -175.721 0 -62.627 -50.436 -104.12 -111.438 -104.12 -80.543 0 -114.687 74.053 -112.234 143.169h-69.156Z" stroke-width="0" />
    </svg>
  </div> -->
</div>
<div class="fixed w-screen h-screen inset-0 top-0 -z-10">
  <div class="absolute w-[150vw] h-[150vh] -left-[25vw] -top-[25vh] inset-0 z-50 backdrop-blur-xl"></div>
  <?php foreach ($site->children()->listed() as $item) : ?>
    <?php
    if (in_array($item->id(), ['artists'])) :
    ?>
      <?php
      $children = $item->children()->sortBy('status', 'asc');
      if ($children->isNotEmpty()) :
      ?>
        <?php foreach ($children as $child) : ?>
          <?php
          $index = $child->indexOf($children);
          ?>
          <img class="artist-background opacity-0" data-artist-slug="<?= $child->slug() ?>" src="<?= $child->cover()->toFile()->resize($width = 500)->url() ?>" alt="<?= $child->title()->esc() ?> - Background Image">
        <?php endforeach ?>
      <?php endif ?>
    <?php endif ?>
  <?php endforeach ?>
</div>
<?php snippet('footer') ?>