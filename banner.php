<?php if ($banner = Asset::URL(__DIR__ . D .  'banner' . D . $state->y->outdoor->banner . '.jpg')): ?>
  <figure class="banner">
    <img alt="<?= eat(i('Photo')); ?>" height="206" src="<?= eat($banner); ?>" width="870">
  </figure>
<?php endif; ?>