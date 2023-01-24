<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php if (!($_SESSION['isAdmin'] == 1)) : ?>
<div class="profile">
  <div style="padding: 20px; border-radius: 5px; box-shadow: 0 0 4px #433e4c; margin-top: 20px; margin-bottom: 20px; background-color: #2e1e26;">
    <div class="container3">
      <section class="message-list">
        <section class="message -left">
          <i class="nes-bcrikko"></i>
          <div class="nes-balloon from-left">
            <p>Hallo <?= $stats['username'] ?> schön das du da bist.</p>
          </div>
        </section>
      </section>
      <div class="container3">
        <div class="text-center">
          <h3>Was möchtest du tun?</h3>
        </div>
        <div>
          <a href="/learn" class="<?= urlIs("/learn") ?> nes-btn">Lernen</a>
          <a href="/game" class="<?= urlIs("/game") ?> nes-btn">Üben</a>
        </div>
      </div>
    </div>
    <div class="container3">
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
    <div class="container4">
      <div>
        <a href="/delete" class="nes-btn is-error">Account löschen</a>
      </div>
    </div>
  </div>
</div>
<?php else : ?>

  <div class="profile">
    <div style="padding: 20px; border-radius: 5px; box-shadow: 0 0 4px #433e4c; margin-top: 20px; margin-bottom: 20px; background-color: #2e1e26;">
<div class="container3">
<table style="display: flex; justify-content: center; align-items: center;">
<tr class="has-top-divider"> 
<th>Username</th>
<th>Email-Adresse</th>
<th>Level</th>
</tr>
<?php foreach($users as $user) {
  echo '<tr class="has-top-divider" >' ;
  echo "<th>". $user['username'] ."</th>"; 
  echo "<th>". $user['email'] ."</th>";
  echo "<th>". $user['level'] ."</th>";
  echo '<th><form method="POST" action="/deleteUser"><input name="username" type="hidden" value="'.$user['username'].'"><input type="submit" name="delete" value="Loeschen"></form></th>';
  echo "</tr>";

}
?>
</tr>
</table>

      </div>
    </div>
  </div>
<?php endif; ?>
<?php require('partials/footer.php') ?>
