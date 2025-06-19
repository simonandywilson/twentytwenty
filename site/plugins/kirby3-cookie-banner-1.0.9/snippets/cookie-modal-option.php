<?php 
$checked = $checked ?? false; 
$disabled = $disabled ?? false; 
$description = $description ?? '';
$id = 'cookie-option-' . $key;
$descriptionId = $id . '-description';
$disabledClasses = $disabled ? 'opacity-70' : '';
?>

<div class="flex flex-col <?= $disabledClasses ?>">
    <div class="flex items-start gap-3">
        <input 
            class="mt-1 focus:ring-3 focus:ring-blue-300 disabled:opacity-60" 
            type="checkbox" 
            id="<?= $id ?>"
            <?php e($checked, 'checked'); ?> 
            <?php e($disabled, 'disabled'); ?> 
            data-cookie-id="<?= $key ?>"
            aria-describedby="<?= $descriptionId ?>"
        >
        <label for="<?= $id ?>" class="cursor-pointer <?php e($disabled, 'cursor-not-allowed'); ?>">
            <span class="font-semibold text-black leading-snug"><?= $title ?></span>
        </label>
    </div>
    <?php if ($description): ?>
        <div class="text-sm text-gray-600 mt-1 ml-6 leading-snug" id="<?= $descriptionId ?>">
            <?= $description ?>
        </div>
    <?php endif; ?>
</div>
