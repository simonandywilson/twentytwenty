<?php
use Kirby\Cms\Html;

/** @var \Kirby\Cms\Block $block */
?>
<?php if ($video = Html::video($block->url())): ?>
<figure>
  <?php 
  // Generate a unique ID for the video and transcript relationship
  $videoId = 'video-' . $block->id();
  $transcriptId = 'transcript-' . $block->id();
  
  // Modify the video HTML to include the ID and aria-describedby if transcript exists
  $videoHtml = $video;
  if ($block->transcript()->isNotEmpty()) {
    // Add ID to the video element
    $videoHtml = str_replace('<video', '<video id="' . $videoId . '" aria-describedby="' . $transcriptId . '"', $video);
  }
  
  echo $videoHtml;
  ?>
  <?php if ($block->caption()->isNotEmpty()): ?>
  <figcaption><?= $block->caption() ?></figcaption>
  <?php endif ?>
  <?php if ($block->transcript()->isNotEmpty()): ?>
    <details>
      <summary aria-label="Show video transcript">Transcript</summary>
      <div class="prose" id="<?= $transcriptId ?>" role="region" aria-label="Transcript for video">
        <?= $block->transcript() ?>
      </div>
    </details>
  <?php endif ?>
</figure>
<?php endif ?>
