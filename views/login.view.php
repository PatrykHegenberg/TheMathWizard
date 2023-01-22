<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<div class="login">
  <div class="container1">
    <form action="/login" method="POST" class="container form">
      <div>
        <h2>Melde dich mit deinem Konto an.</h2>
        <p>
          Oder
          <a href="/register" class="<?= urlIs("/register") ?>">registriere dich noch Heute</a>
        </p>
      </div>
      <div class="nes-field">
        <input name="username" type="text" class="nes-input" placeholder="Username">
      </div>
      <div class="nes-field">
        <input name="password" type="password" class="nes-input" placeholder="Passwort">
      </div>
      <div class="container">
        <label>
          <input type="checkbox" name="remember" class="nes-checkbox is-dark" />
          <span>Angemeldet bleiben</span>
        </label>
        <div>
          <a href="#">Passwort vergessen?</a>
        </div>
      </div>
      <div >
        <button type="submit" name="submit" class="nes-btn is-primary">
          <span>
          </span>
          Anmelden
        </button>
      </div>
    </form>
  </div>
</div>
<?php require('partials/footer.php') ?>
