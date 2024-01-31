  </main>
  <?= js([
    'assets/index.js',
    '@auto'
  ]) ?>
  <?php snippet('cookie-modal') ?>
  <?= css('site/stylesheets/cookie-modal.css') ?>
  <?= js('media/plugins/michnhokn/cookie-banner/cookie-modal.js', ['defer' => true]) ?>
  <?php if (isFeatureAllowed('analytics')) : ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-XXXXXXXX-X"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-XXXXXXXX-X');
    </script>
  <?php endif; ?>
  </body>

  </html>