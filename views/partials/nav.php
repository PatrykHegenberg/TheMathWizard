 <body class="is-boxed">
   <div class="body-wrap boxed-container">
     <header class="site-header has-bottom-divider">
       <div class="container">
       <nav>
         <div class="site-header-inner">
           
             <a href="/" class="<?= urlIs("/") ?> ">
               <img src="./../../images/icon.png" alt="">
             </a>
             <div>
               <?php if (isset($_SESSION['username'])) : ?>
                 <a href="/profile" class="<?= urlIs('/profile') ?> ">Profil</a>
               <?php endif; ?>
             </div>
             <div>
               <?php if (isset($_SESSION['username'])) : ?>
                 <a href="/logout" class="<?= urlIs("/logout") ?> nes-btn ">Abmelden</a>
               <?php else : ?>
                 <a href="/login" class="<?= urlIs('/login') ?> nes-btn">Anmelden</a>
               <?php endif; ?>
             </div>
           
         </div>
         </nav>
       </div>
     </header>
