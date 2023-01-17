<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<div class="register">
  <div class="container2">
<form action="/register" method="POST" class="form">

  <div class="nes-field">
    <label for="username">Username</label>
    <input name="Username" type="text" class="nes-input" placeholder="Username">
  </div>
  <div class="nes-field">
    <label for="vorname">Vorname</label>
    <input name="Vorname" type="text" class="nes-input" placeholder="Vorname">
  </div>
  <div class="nes-field">
    <label for="nachname">Namename</label>
    <input name="Nachname" type="text" class="nes-input" placeholder="Nachname">
  </div>
  <div class="nes-field">
    <label for="enail">Email-Adresse</label>
    <input name="Email-Adresse" type="text" class="nes-input" placeholder="Email-Adresse">
  </div>
  <div class="nes-field">
    <label for="password">Passwort</label>
    <input name="Passwort" type="password" class="nes-input" placeholder="Passwort">
  </div>
  <div class="nes-field">
    <label for="password_check">Passwort wiederholen</label>
    <input name="pw2" type="password" class="nes-input" placeholder="Passwort wiederholen">
  </div>

 <div>
    <button type="submit" name="submit" class="nes-btn is-primary mt-10">
      <span class="absolute inset-y-0 left-0 flex items-center pl-3">
      </span>
        Registrieren
    </button>
  </div> 
</form>
</div>
</div>
<?php require('partials/footer.php') ?>
