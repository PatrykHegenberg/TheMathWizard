<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<main>
  <section class="hero">
    <div class="container">
      <div class="hero-inner">
        <div class="hero-copy">
          <h1 class="hero-title mt-0">Automatisiere spielerisch das 1x1</h1>
          <p class="hero-paragraph">Zeige was du kannst und kämpfe dich durch den Dungeon.</p>
          <div class="hero-cta">
            <a class="<?= urlIs("/login") ?> nes-btn is-primary" href="/login">Starte Jetzt!</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="features section">
    <div class="container">
      <div class="features-inner section-inner has-bottom-divider">
        <div class="features-header text-center">
          <div class="container-sm">
            <h2 class="section-title mt-0">The Math Wizard</h2>
            <p class="section-paragraph">Ohne es zu bemerken lernst du das 1x1.</p>
          </div>
        </div>
        <div class="features-wrap">
          <div class="feature is-revealing">
            <div class="feature-inner">
              <div class="feature-icon">
                <img class="asset-dark" src="./images/weapon_sword_ruby.png" alt="Feature 01">
              </div>
              <div class="feature-content">
                <h3 class="feature-title mt-0">Immer neue Level</h3>
                <p class="text-sm mb-0">Spannende, zufallsgeneriete Level im Dungeon-Crawler-Stil.</p>
              </div>
            </div>
          </div>
          <div class="feature is-revealing">
            <div class="feature-inner">
              <div class="feature-icon">
                <img class="asset-dark" src="./images/monster_imp.png" alt="Feature 02">
              </div>
              <div class="feature-content">
                <h3 class="feature-title mt-0">Angepasste Schwierigkeit</h3>
                <p class="text-sm mb-0">Die Aufgaben passen sich deinen aktuellen Fähigkeiten an.</p>
              </div>
            </div>
          </div>
          <div class="feature is-revealing">
            <div class="feature-inner">
              <div class="feature-icon">
                <img class="asset-dark" src="./images/npc_knight_green.png" alt="Feature 03">
              </div>
              <div class="feature-content">
                <h3 class="feature-title mt-0">Fokus auf das was zählt</h3>
                <p class="text-sm mb-0">Fokus auf das Automatisieren der Multiplikation im Zahlenraum von 1 bis 10.</p>
              </div>
            </div>
          </div>
          <div class="feature is-revealing">
            <div class="feature-inner">
              <div class="feature-icon">
                <img class="asset-dark" src="./images/monster_necromancer.png" alt="Feature 04">
              </div>
              <div class="feature-content">
                <h3 class="feature-title mt-0">Lernfortschritt immer im Blick</h3>
                <p class="text-sm mb-0">Lernziel und Fortschrittskontrolle, um deinen Fortschritt zu verfolgen.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cta section">
    <div class="container-sm">
      <div class="cta-inner section-inner">
        <div class="cta-header text-center">
          <h2 class="section-title mt-0">Bereit los zu legen?</h2>
          <p class="section-paragraph">Fange noch heute an zu lernen.</p>
          <div class="cta-cta">
            <a class="<?= urlIs("/login") ?> nes-btn is-primary" href="/login">Los geht's</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require('partials/footer.php') ?>