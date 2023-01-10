<div class="isolate bg-white">
  <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]">
    <svg class="relative left-[calc(50%-11rem)] -z-10 h-[21.1875rem] max-w-none -translate-x-1/2 rotate-[30deg] sm:left-[calc(50%-30rem)] sm:h-[42.375rem]" viewBox="0 0 1155 678" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill="url(#45de2b6b-92d5-4d68-a6a0-9b9b2abad533)" fill-opacity=".3" d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z" />
      <defs>
        <linearGradient id="45de2b6b-92d5-4d68-a6a0-9b9b2abad533" x1="1155.49" x2="-78.208" y1=".177" y2="474.645" gradientUnits="userSpaceOnUse">
          <stop stop-color="#9089FC"></stop>
          <stop offset="1" stop-color="#FF80B5"></stop>
        </linearGradient>
      </defs>
    </svg>
  </div>
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
</div>
