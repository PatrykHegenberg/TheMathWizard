  <div class="px-6 pt-6 lg:px-8 mb-5">
    <div>
      <nav  class="flex h-9 items-center justify-between" aria-label="Global">
        <div class="flex lg:min-w-0 lg:flex-1" aria-label="Global">
          <a href="/" class="<?= urlIs("/") ?> -m-1.5 p-1.5">
            <span class="sr-only">Your Company</span>
            <img class="h-8" src="./../../images/icon.png" alt="">
          </a>
        </div>
        <div class="lg:flex lg:min-w-0 lg:flex-1 lg:justify-center lg:gap-x-12">
          <?php if(isset($_SESSION['username'])) : ?>
            <a href="/profile" class="<?= urlIs('/profile') ?> text-sm font-semibold text-gray-900 hover:text-gray-900">Dashboard</a>
          <?php endif; ?>
        </div>
        <div class="lg:flex lg:min-w-0 lg:flex-1 lg:justify-end">
          <?php if(isset($_SESSION['username'])) : ?>
            <a href="/logout" class="<?= urlIs("/logout") ?> nes-btn text-sm">Abmelden</a>
          <?php else : ?>
            <a href="/login" class="<?= urlIs('/login') ?> nes-btn text-sm">Anmelden</a>
            <a href="/register" class="<?= urlIs('/register') ?> nes-btn text-sm">Registrieren</a>
          <?php endif; ?>
        </div>
      </nav>
  </div>
  </div>
