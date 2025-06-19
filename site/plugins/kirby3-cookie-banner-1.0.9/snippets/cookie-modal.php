<?php
$assets = isset($assets) ? $assets : false;
$showOnFirst = isset($showOnFirst) ? $showOnFirst : true;
$features = isset($features) ? $features : [];
$features = array_merge(option('michnhokn.cookie-banner.features'), $features);
?>
<?php if ($assets): ?>
    <?= js('media/plugins/michnhokn/cookie-banner/cookie-modal.js', ['defer' => true]) ?>
<?php endif; ?>
<div 
    class="fixed inset-0 z-[1000] flex items-center justify-center p-4 pointer-events-none hidden" 
    id="cookie-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="cookie-modal-title"
    aria-describedby="cookie-modal-description"
    data-show-on-first="<?= $showOnFirst ? 'true' : 'false' ?>"
>
    <div class="absolute inset-0 bg-black/50 pointer-events-auto" aria-hidden="true"></div>
    <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto p-8 bg-white rounded-2xl shadow-2xl pointer-events-auto outline-none" role="document">
        <h1 class="text-xl font-bold mb-4 text-black leading-tight" id="cookie-modal-title"><?= getCookieModalTranslation('title') ?></h1>
        <div class="mb-6 leading-relaxed text-gray-700" id="cookie-modal-description"><?= kti(getCookieModalTranslation('text')) ?></div>
        
        <fieldset class="border-2 border-gray-200 rounded p-4 mb-6">
            <legend class="font-semibold text-black px-2 mb-4">Choose your cookie preferences</legend>
            <div class="flex flex-col gap-4">
                <?php snippet('cookie-modal-option', [
                    'disabled' => true,
                    'checked' => true,
                    'key' => 'essential',
                    'title' => getCookieModalTranslation('essentialText'),
                    'description' => 'Required cookies for basic website functionality'
                ]) ?>
                <?php foreach ($features as $key => $title): ?>
                    <?php snippet('cookie-modal-option', [
                        'disabled' => false,
                        'key' => $key,
                        'title' => t($title, $title),
                        'description' => 'Optional cookie for enhanced functionality'
                    ]) ?>
                <?php endforeach; ?>
            </div>
        </fieldset>
        
        <div class="flex flex-wrap gap-3 justify-start">
            <button 
                type="button" 
                class="flex-1 inline-flex items-center justify-center px-6 py-0 bg-black text-white font-bold rounded-full border-2 border-gray-900 min-h-[44px] min-w-[44px] focus:outline-none focus-visible:bg-blue-600" 
                id="cookie-accept"
                aria-describedby="accept-description"
            >
                <span><?= getCookieModalTranslation('acceptAll') ?></span>
            </button>
            <button 
                type="button" 
                class="flex-1 inline-flex items-center justify-center px-6 py-0 bg-white text-black font-bold rounded-full border-2 border-gray-900 min-h-[44px] min-w-[44px] focus:outline-none  focus-visible:bg-blue-600 focus-visible:text-white " 
                id="cookie-deny"
                aria-describedby="deny-description"
            >
                <span><?= getCookieModalTranslation('denyAll') ?></span>
            </button>
            <button 
                type="button" 
                class="hidden flex-1 inline-flex items-center justify-center px-6 py-0 bg-white text-black font-bold rounded-full border-2 border-gray-900 min-h-[44px] min-w-[44px] focus:outline-none focus-visible:bg-blue-600 focus-visible:text-white " 
                id="cookie-save"
                aria-describedby="save-description"
            >
                <span><?= getCookieModalTranslation('save') ?></span>
            </button>
        </div>
        
        <!-- Screen reader descriptions for buttons -->
        <div class="sr-only">
            <div id="accept-description">Accept all cookies including optional tracking and analytics</div>
            <div id="deny-description">Reject all optional cookies, keep only essential ones</div>
            <div id="save-description">Save your current cookie preferences</div>
        </div>
    </div>
</div>

<?php if ($assets): ?>
    <?= js('media/plugins/michnhokn/cookie-banner/cookie-modal.js', ['defer' => true]) ?>
<?php endif; ?>

