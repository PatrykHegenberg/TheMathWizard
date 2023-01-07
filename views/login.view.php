<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="w-full max-w-md space-y-8 nes-container">
<form action="#" method="POST">
  <div>
    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Melde dich mit deinem Konto an.</h2>
    <p class="mt-2 text-center text-sm text-gray-600">
      Oder
      <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">registriere dich noch Heute</a>
    </p>
  </div> 
  <div class="nes-field">
    <!--<label for="name_field">Email-Adresses</label>-->
    <input type="text" class="nes-input" placeholder="Email-Adresses">
  </div>
  <div class="nes-field">
    <!--<label for="name_field">Passwort</label>-->
    <input type="text" class="nes-input" placeholder="Passwort">
  </div>
  <div class="flex items-center justify-between">
    <label class="flex items-center justify-between">
      <input type="checkbox" class="nes-checkbox" />
      <span>Angemeldet bleiben</span>
    </label>
    <div class="text-sm">
      <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Passwort vergessen?</a>
    </div> 
  </div>
 <div>
    <button type="submit" class="nes-btn is-primary">
      <span class="absolute inset-y-0 left-0 flex items-center pl-3">
      </span>
        Anmelden
    </button>
  </div> 
</form>
</div>
</div>
<?php require('partials/footer.php') ?>
