<?php if ($block->videoId()->isNotEmpty()): ?>
<figure class="w-full">
  <div class="relative w-full pb-[calc(56.25%+134px)]">
    <iframe
      class="absolute top-0 left-0 w-full h-full border-0"
      marginwidth="0"
      marginheight="0"
      src="//plugin.3playmedia.com/show?ad=1&ad_autoplay=0&ad_default_source_volume_control=0&ad_source_volume_control=0&cc=1&cc_minimizable=0&cc_minimize_on_load=1&cc_multi_text_track=0&cc_overlay=0&cc_searchable=0&embed=iframe&height=auto&itx=1&itx_collapse_on_load=1&itx_collapsible=1&itx_downloadable=0&itx_highlight_by_caption_frames=0&itx_keywords=0&itx_light_scroll=0&itx_multi_text_track=0&itx_progress_bar=0&itx_progressive_tracking=0&mf=12961354&p3sdk_version=1.11.7&p=67226&player_type=youtube&plugin_skin=light&video_id=<?= $block->videoId()->esc() ?>&video_target=tpm-plugin-k9mg9lks-<?= $block->videoId()->esc() ?>&width=auto"
      title="Video Player"
      <?php if ($block->caption()->isNotEmpty()) : ?>
      aria-describedby="vid-caption-<?= $block->id() ?>"
      <?php endif; ?>
    ></iframe>
  </div>
  <?php if ($block->caption()->isNotEmpty()) : ?>
    <figcaption class="figcaption" id="vid-caption-<?= $block->id() ?>">
      <?= $block->caption()->kt() ?>
    </figcaption>
  <?php endif ?>
</figure>
<?php endif ?>