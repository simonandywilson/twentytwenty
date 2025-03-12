<?php
/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  Block snippets control the HTML for individual blocks
  in the blocks field. This video snippet overwrites
  Kirby's default video block to add custom classes
  and style attributes.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
<?php if ($block->url()->isNotEmpty()): ?>
<figure class="w-full">
  <span class="video" style="--w:16;--h:9">
    <?php 
      // Generate unique IDs for accessibility
      $videoId = 'video-' . $block->id();
      $transcriptId = 'transcript-' . $block->id();
      
      $videoTitle = $block->caption()->isNotEmpty() ? $block->caption()->esc() : 'Video content';
      $videoEmbed = video($block->url(), [
        'options' => [
          'title' => 1,
          'controls' => 1,
          'autoplay' => 0,
          'rel' => 0
        ]
      ]);
      
      // Add accessibility attributes
      $ariaAttributes = $block->transcript()->isNotEmpty() ? ' aria-describedby="' . $transcriptId . '"' : '';
      echo str_replace('<iframe', '<iframe id="' . $videoId . '"' . $ariaAttributes . ' title="' . $videoTitle . '" aria-label="' . $videoTitle . '"', $videoEmbed);
    ?>
  </span>
  <?php if ($block->caption()->isNotEmpty()): ?>
  <figcaption class="figcaption" id="video-caption-<?= $block->id() ?>"><?= $block->caption() ?></figcaption>
  <?php endif ?>
  
  <?php if ($block->transcript()->isNotEmpty()): ?>
    <details class="figcaption -mt-[1px]">
      <summary aria-label="Show video transcript">Video Transcript</summary>
      <div class="prose" id="<?= $transcriptId ?>" role="region" aria-label="Transcript for video">
        <?= $block->transcript() ?>
      </div>
    </details>
  <?php endif ?>
</figure>
<?php endif ?>
