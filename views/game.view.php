<!doctype html>
<html lang="de">
  <head>
    <title>The Math Wizard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Lerne spielerisch das 1x1.">
    <link rel="icon" href="./../images/icon.png">
    <script src="https://cdn.jsdelivr.net/npm/rot-js@2/dist/rot.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/chr15m/jsfxr@42a643f/riffwave.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/chr15m/jsfxr@42a643f/sfxr.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/nes.css@2.3.0/css/nes.min.css" rel="stylesheet">
<link href="./../styles/game.css" rel="stylesheet" id="style">
  </head>
  <body>
    <span class="metadata" id="playerStats" style="display:none"><?php echo json_encode($stats) ?></span>
    <!-- boilerplate splash -->
    <div class="screen" id="plate">
      <div>
        <img src="./../images/icon.png" id="logo">
        <p>The<br/>Math<br/>Wizard</p>
      </div>
    </div>

    <!-- title screen -->
    <div id="title" class="screen">
      <div class="game-title-animation">
        <!-- The game title is set dynamically at the start of main.js -->
        <svg id="game-title" viewBox="0 0 700 200" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <path id="curve" d="M 100 150 C 200 100 500 100 600 150"/>
          </defs>
          <text stroke-width="10px" stroke="white">
            <textPath xlink:href="#curve" text-anchor="middle" startOffset="50%">
              <tspan class="game-title-text">The Math Wizard</tspan>
            </textPath>
          </text>
          <text fill="#e33" stroke-width="10px">
            <textPath xlink:href="#curve" text-anchor="middle" startOffset="50%">
              <tspan class="game-title-text">The Math Wizard</tspan>
            </textPath>
          </text>
        </svg>
      </div>
      <div id="options">
        <div id="menu" class="nes-container is-rounded is-dark">
          <label>
            <input type="radio"
                   value="instructions"
                   class="nes-radio is-dark"
                   name="menu-items"
                   checked/>
            <span>Anleitung</span>
          </label>
		  <br/>
          <label>
            <input type="radio"
                   value="credits"
                   class="nes-radio is-dark"
                   name="menu-items"/>
            <span>Credits</span>
          </label>
        </div>
      </div>
      <button id="play" class="nes-btn is-success action">Start</button>
    </div>

    <!-- credits screen -->
    <div id="credits" class="screen modal">
      <div class="nes-container is-rounded is-dark">
        <p>By Patryk Hegenberg</p>
        <ul>
          <li>Engine =
            <a href="https://ondras.github.io/rot.js/hp/"
               target="_blank">ROT.js</a></li>
          <li>Tiles by
            <a href="https://0x72.itch.io/16x16-dungeon-tileset"
               target="_blank">0x72</a></li>
          <li>Styles from
            <a href="https://nostalgic-css.github.io/NES.css/"
               target="_blank">NESS.css</a></li>
          <li>SFX from
            <a href="https://sfxr.me/"
               target="_blank">sfxr.me</a></li>
          <li>Pixel coin by
            <a href="https://opengameart.org/content/spinning-pixel-coin-0"
               target="_blank">irmirx</a></li>
          <li>Parts of the Gamelogic and Design by
            <a href="http://roguebasin.com/index.php/Roguelike_Browser_Boilerplate">chr15m</a</li>
        </ul>
      </div>
      <button class="nes-btn is-success action">Ok</button>
    </div>    

    <!-- instructions screen -->
    <div id="instructions" class="screen modal">
      <p>Anleitung</p>
      <div class="nes-container is-rounded is-dark">
        <p>Kämpfe dich durch denn Dungeon und finde den Weg in den untersten Raum. Durch das Lösen der Matheaufgaben fügst deinen Gegnern Schaden zu.
        Bei einer falschen Antwort erleidest du Schaden.</p>
        <p>Benutze die WASD um dich zu bewegen.</p>
      </div>
      <button class="nes-btn is-success action">Ok</button>
    </div>

    <!-- win screen -->
    <div id="win" class="screen modal">
      <p class="nes-container is-rounded is-dark">Win!</p>
      <div class="nes-container is-rounded is-dark">
        <p>Du hast das Spiel gewonnen.</p>
        <p>Du hast <span class="gold-stat"></span> Gold und <span class="xp-stat"></span> XP erhalten.</p>
      </div>
        <button onclick="javascript:window.location.href='/profile'" class="nes-btn is-success action">Ok</button>
    </div>

    <!-- lose screen -->
    <div id="lose" class="screen modal">
      <p>Lose!</p>
      <div class="nes-container is-rounded is-dark">
        <p>Oh nein, die Monster haben dich erwischt.</p>
        <p>Du bist tot.</p>
        <p>Du hast <span class="gold-stat"></span> Gold und <span class="xp-stat"></span> XP erhalten.</p>
      </div>
      <button onclick="javascript:window.location.href='/profile'" class="nes-btn is-success action">Ok</button>
    </div>
    
    <!--Combat screen-->
    <div id="combat" class="screen modal combat">
      <p>Kampf!</p>
      <div class="nes-container is-rounded is-dark">
        <p id>Was ist?</p>
        <p id="question"></p>
      </div>
      <button id="answer1" class="nes-btn is-success action">Antwort 1</button>
      <button id="answer2" class="nes-btn is-success action">Antwort 2</button>
      <button id="answer3" class="nes-btn is-success action">Antwort 3</button>
    </div>

    <!-- game screen -->
    <div id="game" class="screen">
      <div id="canvas"></div>
      <div id="message" class="nes-container is-rounded is-dark hide"></div>
      <div id="hud" class="nes-container is-rounded is-dark"></div>
    </div>

  </body>
  <script src="./../scripts/game.js" id="main"></script>
</html>
