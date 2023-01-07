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
            <span>Instructions</span>
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
      <button id="play" class="nes-btn is-success action">Play</button>
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
            <a href="https://kenney.nl/assets/micro-roguelike"
               target="_blank">kenney.nl</a></li>
          <li>Styles from
            <a href="https://nostalgic-css.github.io/NES.css/"
               target="_blank">NESS.css</a></li>
          <li>SFX from
            <a href="https://sfxr.me/"
               target="_blank">sfxr.me</a></li>
          <li>Pixel coin by
            <a href="https://opengameart.org/content/spinning-pixel-coin-0"
               target="_blank">irmirx</a></li>
        </ul>
      </div>
      <button class="nes-btn is-success action">Ok</button>
    </div>    

    <!-- instructions screen -->
    <div id="instructions" class="screen modal">
      <p>Instructions</p>
      <div class="nes-container is-rounded is-dark">
        <p>Du musst dich durch denn Dungeon kämpfen und denn Weg in den höchsten Raum finden. du kämpfst durch das Lösen von Matheaufgaben.
        Solltest du eine falsche Antwort geben erleidest du Schaden, ansonsten fügst du deinem Gegner Schaden zu.</p>
        <p>Benutze die Pfeiltasten um dich zu bewegen.</p>
      </div>
      <button class="nes-btn is-success action">Ok</button>
    </div>

    <!-- win screen -->
    <div id="win" class="screen modal">
      <p class="nes-container is-rounded is-dark">Win!</p>
      <div class="nes-container is-rounded is-dark">
        <p><div class="sprite amulet"></div></p>
        <p>Du hast das Spiel gewonnen.</p>
        <p>Du hast <span class="gold-stat"></span> Gold und <span class="xp-stat"></span> XP erhalten.</p>
      </div>
      <button class="nes-btn is-success action">Ok</button>
    </div>

    <!-- lose screen -->
    <div id="lose" class="screen modal">
      <p>Lose!</p>
      <div class="nes-container is-rounded is-dark">
        <div class="sprite tomb"></div>
        <p>Oh nein, die Monster haben dich erwischt.</p>
        <p>Du bist tot.</p>
        <p>Du hast <span class="gold-stat"></span> Gold und <span class="xp-stat"></span> XP erhalten.</p>
      </div>
      <button class="nes-btn is-success action">Ok</button>
    </div>
    
    <!--Combat screen-->
    <div id="combat" class="screen modal">
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
      <div id="arrows">
        <div id="btn-left" class="nes-container is-rounded is-dark"><span>&lt;</span></div>
        <div id="btn-up" class="nes-container is-rounded is-dark"><span>&lt;</span></div>
        <div id="btn-down" class="nes-container is-rounded is-dark"><span>&gt;</span></div>
        <div id="btn-right" class="nes-container is-rounded is-dark"><span>&gt;</span></div>
        <div id="btn-skip" class="nes-container is-rounded is-dark"><span>.</span></div>
      </div>
    </div>

  </body>
  <script src="./../scripts/game.js" id="main"></script>
</html>
