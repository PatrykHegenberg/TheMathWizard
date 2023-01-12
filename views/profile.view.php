<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<div class="container profile">
  <div>
    <div class="nes-container">
      <section class="message-list">
        <section class="message -left">
          <i class="nes-bcrikko"></i>
          <div class="nes-balloon from-left">
            <p>Hallo <?= $stats['username'] ?> schön das du da bist.</p>
          </div>
        </section>
      </section>
      <div class="nes-container">
        <div class="text-center">
          <h3>Was möchtest du tun?</h3>
        </div>
        <div>
          <!--<a href="/learn" class="<?= urlIs("/learn") ?> nes-btn">Lernen</a>-->
          <a href="/game" class="<?= urlIs("/game") ?> nes-btn">Üben</a>
        </div>
      </div>
    </div>
    <div class="nes-container with-title">
      <span class="title">Dein Fortschritt</span>
      <span>Du bist aktuell Level: <?php echo $stats['level'] ?> </span>
      <br>
      <span>Deine Erfahrungspunkte</span>
      <progress class="nes-progress is-primary" value="<?php echo $stats['xp'] ?>" max="150">Erfahrung</progress>
      <span>Dein aktueller Lernfortschritt</span>
      <progress class="nes-progress is-success" value="<?php echo $stats['lesson_count'] ?>" max="10">Absolvierte Lektionen</progress>
      <div class="flex flex-rows justify-center">
        <div>
          <span><i class="nes-icon coin is-medium"></i></span>
        </div>
        <div>
          <p><?php echo $stats['coins'] ?></p>
        </div>
      </div>
    </div>
    <div class="nes-container">
      <div>
        <a href="/delete" class="nes-btn is-error">Account löschen</a>
      </div>
    </div>
  </div>
</div>
<?php require('partials/footer.php') ?>