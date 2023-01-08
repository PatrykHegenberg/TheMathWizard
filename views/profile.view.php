<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="flex-col">
    <div class="w-1000 space-y-8 nes-container">
      <section class="message-list flex-auto">
        <section class="message -left flex space-x-10">
          <i class="nes-bcrikko mr-10"></i>
          <div class="nes-balloon from-left mx-10">
            <p>Hallo <?= $_SESSION['username'] ?> schön das du da bist.</p>
          </div>
        </section>
      </section>
      <div class="nes-container flex-col justife-center items-center space-y-4">
        <div class="text-center">
          <h1>Was möchtest du tun?</h1>
        </div>
        <div class="flex justify-evenly items-center">
          <a href="/learn" class="<?= urlIs("/learn") ?> nes-btn">Lernen</a>
          <a href="/game" class="<?= urlIs("/game") ?> nes-btn">Üben</a>
        </div>
      </div>
    </div>
    <div class="nes-container with-title mt-10 space-y-4">
      <span class="title">Dein Fortschritt <?php $_SESSION['xp'] ?> </span>
      
      <span>Du bist aktuell Level: <?php echo $_SESSION['level'] ?> </span>
      <br>
      <span>Deine Erfahrungspunkte</span>
      <progress class="nes-progress is-primary" value="<?php echo $_SESSION['xp'] ?>" max="150">Erfahrung</progress>
      <span>Dein aktueller Lernfortschritt</span>
      <progress class="nes-progress is-success" value="<?php echo $_SESSION['lesson_count'] ?>" max="10">Absolvierte Lektionen</progress>
      <div class="flex flex-rows justify-center">
        <div>
          <span><i class="nes-icon coin is-medium"></i></span>
        </div>
        <div>
          <p><?php echo $_SESSION['coins'] ?></p>
        </div>
      </div>
    </div>
    <div class="nes-container mt-10">
      <div>
      <a href="/delete" class="nes-btn is-error">Account löschen</a> 
      </div>
    </div>
  </div>
</div>
<?php require('partials/footer.php') ?>
