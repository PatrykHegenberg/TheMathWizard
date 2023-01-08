<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
<div class="w-full max-w-md space-y-8 nes-container">
<h1>Dieses ist die Profile Page</h1>
<a href="/logout" class="<?= urlIs("/logout") ?> nes-btn">Abmelden</a>
</div>
</div>
<?php require('partials/footer.php') ?>
