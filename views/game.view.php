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
<style>
 @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P');

.game-title-text {
  font-size: 32px;
}

* {
  box-sizing: border-box;
  touch-action: manipulation;
  user-select: none;
  -webkit-user-select: none;
  -webkit-touch-callout: none;
}

html {
  height: 100%;
  overflow: hidden;
}

body {
  font-family: 'Press Start 2P', cursive;
  width: 100%;
  height: 100%;
  margin: 0px auto;
  font-size: 1.5em;
  background-color: #222323;
  color: #eee;
}

@media (max-width: 700px), (max-height: 820px) {
 body {
   font-size: 0.75em;
 }
}

canvas {
  image-rendering: optimizeSpeed;
  image-rendering: crisp-edges;
  image-rendering: -moz-crisp-edges;
  image-rendering: -o-crisp-edges;
  image-rendering: -webkit-optimize-contrast;
  -ms-interpolation-mode: nearest-neighbor;
  image-rendering: pixelated;
}

a {
  color: #e77;
}

a:hover {
  color: #faa;
  text-decoration: none;
}

/*** NES.css overrides ***/

.nes-container.is-rounded.is-dark {
  border-image-slice: 9 9 9 9 fill;
  border-image-source: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAphgAAKYYBIuzfjAAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAABgSURBVEiJY2AYBQQAIzGK/v///x+rZkZGgvqZSHURqYDmFrDgkkAOFikpZYJqcAXX0A8iFG8REyy4wLNndxGGIgXX0A+iUQsIApxlCTEpClfKQQbDOIiQwcgurkcBQQAARlMedugABy8AAAAASUVORK5CYII=');
  background-color: transparent;
  border-image-repeat: stretch;
}

.nes-container.is-fake-rounded.is-dark::after {
  background: none;
}

/*** screens ***/

.screen {
  height: 100%;
  width: 100%;
  display: none;
  flex-direction: column;
  position: absolute;
  justify-content: center;
  align-items: center;
}

.modal {
  position: absolute;
  top: 0px;
  left: 0px;
  bottom: 0px;
  right: 0px;
  width: 100%;
  height: 100%;
  background-color: #222323;
}

#title {
  background-image: url(./../images/bg.png);
  background-size: cover;
  animation: 20s para infinite ease;
}

@keyframes para {
    0% {
      background-position: 0px 0%;
    }
    50% {
      background-position: 0px 80px;
    }
    100% {
      background-position: 0px 0px;
    }
}

#plate {
  display: flex;
  animation: 2s plate-fade;
  opacity: 0;
}

#plate > div {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: left;
  padding: 40px;
  border-radius: 5px;
}

@keyframes plate-fade {
  0% {
    opacity: 0;
  }
  25% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  75% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

#plate > div > * + * {
  margin-left: 32px;
  margin-right: 0px;
}

@media (max-width: 700px), (max-height: 820px) {
  #plate > div {
    flex-direction: column;
    text-align: center;
  }

  #plate > div > * + * {
    margin-left: 0px;
    margin-right: 0px;
    margin-top: 16px;
  }
}

#game-title {
  margin-bottom: 0px;
  width: 900px;
  max-width: 98%;
}

@media (min-width: 700px) and (max-height: 820px) {
  #game-title {
    width: 900px;
    max-width: 98%;
    max-height: 35vh;
  }
}

@media (max-height: 600px) {
  #game-title {
    width: 500px;
  }
}

.game-title-animation {
  animation: 2s zoomInDown;
}

/* https://github.com/animate-css/animate.css/blob/master/animate.css */
@keyframes zoomInDown {
  0% {
    opacity: 0;
    transform: scale3d(0.1, 0.1, 0.1) translate3d(0, -1000px, 0);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }

  60% {
    opacity: 1;
    transform: scale3d(0.475, 0.475, 0.475) translate3d(0, 60px, 0);
    animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1);
  }
}

#options {
  text-align: center;
  justify-content: center;
  max-width: 90%;
}

#logo {
  width: 100px;
}

#menu {
  width: 400px;
  max-width: 100%;
  margin-bottom: 64px;
  padding: 32px;
}

#menu label {
  margin-left: -1em;
  padding-top: 0.5em;
  padding-bottom: 0.5em;
}

.modal > * {
  max-width: 90%;
  width: 400px;
  margin: 50px;
  text-align: center;
}

@media (max-width: 700px), (max-height: 820px) {
  .modal > * {
    margin: 10px;
  }
}

#instructions div > p {
  text-align: left;
}

#settings div > p {
  text-align: left;
}

#credits ul {
  list-style: "> ";
  padding-left: 2em;
  text-align: left;
}

#credits ul li {
  margin: 0.5em 0px;
}

.sprite {
  display: block;
  width: 8px;
  height: 8px;
  image-rendering: optimizeSpeed;
  image-rendering: crisp-edges;
  image-rendering: -moz-crisp-edges;
  image-rendering: -o-crisp-edges;
  image-rendering: -webkit-optimize-contrast;
  -ms-interpolation-mode: nearest-neighbor;
  image-rendering: pixelated;
  transform: scale(8);
  background-image: url("./../images/colored_tilemap_packed.png");
  margin: 80px auto;
}

.free {
  position: absolute;
  transform: none;
}


.tomb {
  background-position: -72px -56px;
}

.ghost {
  background-position: -72px -8px;
  margin: 0px;
}

.empty {
  background-position: -8px -48px;
}

.float-up {
  animation: float-up 2s linear forwards;
}

@keyframes float-up {
  from {
    transform: scale(1) translate(0px, 0px);
    opacity: 1;
  }
  to {
    transform: scale(3) translate(0px, -20px);
    opacity: 0;
  }
}

.grow-fade {
  animation: grow-fade 2s linear;
}

@keyframes grow-fade {
  from {
    transform:  translate(0px, 0px) scale(8);
    opacity: 0.5;
  }
  to {
    transform: translate(0px, 0px) scale(16);
    opacity: 0;
  }
}

#play {
  width: 400px;
  max-width: 90%;
}

#win {
  background: url(01coin.gif);
  background-size: 20%;
}

/*** HUD ***/

#hud {
  position: absolute;
  bottom: 0px;
  width: 600px;
  max-width: 100%;
  display: flex;
  justify-content: space-evenly;
  padding: 24px;
}

#message {
  position: absolute;
  top: 24px;
  flex-direction: column;
}

#message .hit {
  color: #C01256;
}

#message .miss {
  color: #FFB570;
}

#inventory {
  position: absolute;
  bottom: 0px;
  left: 0px;
}

#inventory .sprite {
  transform: scale(3);
  display: inline-block;
  margin: 1em 2em 1em 1em;
  vertical-align: middle;
}

#inventory li {
  margin: 1em 0px;
}

#inventory ul {
  list-style-type: none;
  margin: 0px;
  padding: 0px;
}

#inventory > div {
  display: none;
}

@media (max-width: 750px) {
  #inventory {
    bottom: 72px;
  }

  #hud {
    width: 100%;
  }
}

#arrows {
  display: none;
  position: absolute;
  right: 0px;
  bottom: 0px;
}

#arrows > * {
  float: left;
  font-size: 16px;
  bottom: 0px;
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
}

#arrows > * > span {
  pointer-events: none;
}

#btn-left {
  position: absolute;
  right: 7em;
}

#btn-right {
  position: absolute;
  right: 0em;
}

#btn-up {
  transform: rotate(90deg);
  position: absolute;
  right: 3.5em;
  margin-bottom: 3.75em;
}

#btn-down {
  transform: rotate(90deg);
  position: absolute;
  right: 3.5em;
}

#btn-skip {
  position: absolute;
  right: 0em;
  margin-bottom: 3.75em;
  padding: 0px;
}

@media (max-width: 1024px) {
   #arrows > * {
     bottom: 72px;
   }
}

/*** CSS animations ***/

.fade-in {
  animation: fade-in 0.8s;
  display: flex;
}

@keyframes fade-in {
  from{opacity:0} to{opacity:1}
}

.hide {
  display: none;
}

.show {
  display: flex;
}

.fade-out {
  display: flex;
  opacity: 1;
  animation: fade-out 3s forwards;
}

@keyframes fade-out {
  from{opacity:1; display: flex;} 50%{opacity:1; display: flex;} to{opacity:0; display: none;}
} 
</style>
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
              <tspan class="game-title-text">Roguelike</tspan>
            </textPath>
          </text>
          <text fill="#e33" stroke-width="10px">
            <textPath xlink:href="#curve" text-anchor="middle" startOffset="50%">
              <tspan class="game-title-text">Roguelike</tspan>
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
        <p>Du hast dich bis zum Ende des Spiels durchgekämpft und hast das Spiel gewonnen.</p>
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
        <div class="sprite tomb"></div>
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
<script id="main">
  (function (w) {
  let count = 1;
  // game title
  const gametitle = "The Math Wizard";

  /*****************
   *** resources ***
   *****************/

  // This tileset is from kenney.nl
  // It's the "microrogue" tileset

  const tileSet = document.createElement("img");
  tileSet.src = "./../images/colored_tilemap_packed.png";

  const tileOptions = {
    layout: "tile",
    bg: "transparent",
    tileWidth: 8,
    tileHeight: 8,
    tileSet: tileSet,
    tileMap: {
      "@": [40, 0], // player
      ".": [32, 32], // floor
      "M": [88, 0], // monster
      "*": [72, 24], // treasure chest
      "g": [64, 40], // gold
      "x": [56, 32], // axe
      "p": [56, 64], // potion
      "a": [40, 32], // tree 1
      "b": [32, 40], // tree 2
      "c": [40, 40], // tree 3
      "d": [48, 40], // tree 4
      "e": [56, 40], // tree 5
      "T": [72, 56], // tombstone
      "╔": [0, 72], // room corner
      "╗": [24, 72], // room corner
      "╝": [72, 72], // room corner
      "╚": [48, 72], // room corner
      "═": [8, 72], // room edge
      "║": [32, 72], // room edge
      "o": [40, 72], // room corner
      "D": [16, 16], //Door to win
      "s": [32, 24], //stairs to next Stage
    },
    width: 25,
    height: 40,
  };

  const usePointer = true;
  const useArrows = true;
  const touchOffsetY = -20; // move the center by this much
  const scaleMobile = 4; // scale mobile screens by this much
  const scaleMonitor = 6; // scale computer screens by this much
  const turnLengthMS = 200; // shortest time between turns

  // these map tiles are walkable
  const walkable = [".", "*", "g", "D", "s"];

  // these map tiles should not be replaced by room edges
  const noreplace = walkable.concat(["M", "╔", "╗", "╚", "╝", "═", "║"]);

  // These sound effects are generated using sfxr.me

  const sfx = {
    rubber:
      "5EoyNVaezhPnpFZjpkcJkF8FNCioPncLoztbSHU4u9wDQ8W3P7puffRWvGMnrLRdHa61kGcwhZK3RdoDRitmtwn4JjrQsZCZBmDQgkP5uGUGk863wbpRi1xdA",
    step: "34T6PkwiBPcxMGrK7aegATo5WTMWoP17BTc6pwXbwqRvndwRjGYXx6rG758rLSU5suu35ZTkRCs1K2NAqyrTZbiJUHQmra9qvbBrSdbBbJ7JvmyBFVDo6eiVD",
    choice:
      "34T6PkzXyyB6jHiwFztCFWEWsogkzrhzAH3FH2d97BCuFhqmZgfuXG3xtz8YYSKMzn95yyX8xZXJyesKmpcjpEL3dPP5h2e8mt5MmhExAksyqZyqgavBgsWMd",
    hide: "34T6PkzXyyB6jHiwFztCFWEniygA1GJtjsQuGxcd38JLDquhRqTB28dQgigseMjQSjSY14Z3aBmAtzz9KWcJZ2o9S1oCcgqQY4dxTAXikS7qCs3QJ3KuWJUyD",
    empty:
      "111112RrwhZ2Q7NGcdAP21KUHHKNQa3AhmK4Xea8mbiXfzkxr9aX41M8XYt5xYaaLeo9iZdUKUVL3u2N6XASue2wPv2wCCDy6W6TeFiUjk3dXSzFcBY7kTAM",
    hit: "34T6Pks4nddGzchAFWpSTRAKitwuQsfX8bfzRpJx5eDR7NSqxeeLMEkLjcuwvTCDS1ve7amXBg4eipzDdgKWoYnJBsQVESZh2X1DFV2GWybY5bAihB2EdHsbd",
    miss: "8R25jogvbp3Qy6A4GTPxRP4aT2SywwsAgoJ2pKmxUFMExgNashjgd311MnmZ2ThwrPQz71LA53QCfFmYQLHaXo6SocUv4zcfNAU5SFocZnoQSDCovnjpioNz3",
    win: "34T6Pkv34QJsqDqEa8aV4iwF2LnASMc3683oFUPKZic6kVUHvwjUQi6rz8qNRUHRs34cu37P5iQzz2AzipW3DHMoG5h4BZgDmZnyLhsXgPKsq2r4Fb2eBFVuR",
    lose: "7BMHBGHKKnn7bgcmGprqiBmpuRaTytcd4JS9eRNDzUTRuQy8BTBzs5g8XzS7rrp4C9cNeSaqAtWR9qdvXvtnWVTmTC8GXgDuCXD2KyHJNXzfUahbZrce8ibuy",
    kill: "7BMHBGKMhg8NZkxKcJxNfTWXKtMPiZVNsLR4aPEAghCSpz5ZxpjS5k4j4ZQpJ65UZnHSr4R2d7ALCHJe41pAS2ZPjauM7SveudhDGAxw2dhXpiNwEhG8xUYkX",
  };

  for (let s in sfx) {
    sfx[s] = new SoundEffect(sfx[s]).generate().getAudio();
  }

  const keyMap = {
    38: 0,
    33: 1,
    39: 2,
    34: 3,
    40: 4,
    35: 5,
    37: 6,
    36: 7,
  };

  /*****************
   *** game code ***
   *****************/

  // based on the original tutorial by Ondřej Žára
  // www.roguebasin.com/index.php?title=Rot.js_tutorial,_part_1

  const Game = {
    // this is the ROT.js display handler
    display: null,
    // this is our map data
    map: {},
    // map of all items
    items: {},
    // reference to the ROT.js engine which
    // manages stuff like scheduling
    engine: null,
    // schedules events in the game for ROT.js
    scheduler: null,
    // reference to the player object
    player: null,
    // reference to the game monsters array
    monsters: null,
    door: null,
    // arrow handler
    lastArrow: null, // arrow keys held
    arrowInterval: null, // arrow key repeat
    arrowListener: null, // registered listener for arrow event
    // clean up this game instance
    cleanup: cleanup,
    playerAllowedToMove: true,
  };

  // this gets called by the menu system
  // to launch the actual game
  function init(game) {
    game.map = {};
    game.items = {};
    // first create a ROT.js display manager
    game.display = new ROT.Display(tileOptions);
    resetCanvas(game.display.getContainer());

    generateMap(game, count);

    // let ROT.js schedule the player and monster entities
    game.scheduler = new ROT.Scheduler.Simple();
    game.scheduler.add(game.player, true);
    game.monsters.map((m) => game.scheduler.add(m, true));

    // render the stats hud at the bottom of the screen
    renderStats(game.player.stats);

    // kick everything off
    game.engine = new ROT.Engine(game.scheduler);
    game.engine.start();
    count = 1;
  }

  function nextStage(game, stage, stats) {
    game.map = {};
    game.items = {};
    game.display = new ROT.Display(tileOptions);
    resetCanvas(game.display.getContainer());
    if (game.engine) {
      game.scheduler.clear();
      game.scheduler = null;
      game.monsters = null;
      game.door = null;
      game.stairs = null;
    };
    generateMap(game, stage);

    // let ROT.js schedule the player and monster entities
    game.scheduler = new ROT.Scheduler.Simple();
    game.scheduler.add(game.player, true);
    game.monsters.map((m) => game.scheduler.add(m, true));

    // render the stats hud at the bottom of the screen
    game.player.stats = stats;
    renderStats(game.player.stats);

    // kick everything off
    game.engine = new ROT.Engine(game.scheduler);
    game.engine.start();;
  }

  // this gets called at the end of the game when we want
  // to exit back out and clean everything up to display
  // the menu and get ready for next round
  function destroy(game) {
    // remove all listening event handlers
    removeListeners(game);

    // tear everything down
    if (game.engine) {
      game.engine.lock();
      game.display = null;
      game.map = {};
      game.items = {};
      game.engine = null;
      game.scheduler.clear();
      game.scheduler = null;
      game.player = null;
      game.monsters = null;
      game.door = null;
      game.stairs = null;
    }

    // hide the toast message
    hideToast(true);
    // close out the game screen and show the title
    showScreen("title");
  }

  // this generates the game map
  function generateMap(game, stage) {
    const digger = new ROT.Map.Digger(tileOptions.width, tileOptions.height);
    // list of floor tiles that can be walked on
    const freeCells = [];
    // list of non-floor tiles that can't be traversed
    const zeroCells = [];

    const digCallback = function (x, y, value) {
      const key = x + "," + y;
      if (value) {
        zeroCells.push(key);
      } else {
        game.map[key] = ".";
        freeCells.push(key);
      }
    };
    digger.create(digCallback.bind(game));

    generateItems(game, freeCells);
    generateScenery(game.map, zeroCells);
    generateRooms(game.map, digger);

    game.player = createBeing(makePlayer, freeCells);
    game.monsters = []
    for ( var i= 0; i<= stage; i++) {
      game.monsters.push(createBeing(makeMonster, freeCells));
    }

    // draw the map and items
    for (let key in game.map) {
      drawTile(game, key);
    }

    rescale(game.player._x, game.player._y, game);
  }

  function generateItems(game, freeCells) {
    for (let i = 0; i < 15; i++) {
      const key = takeFreeCell(freeCells);
      if (!i) {
        if(count < 5) {
          game.stairs = key;
          game.items[key] = "s";
        } else {
          game.door = key;
          game.items[key] = "D";
        }
      } else {
        game.items[key] = ROT.RNG.getItem(["g"]);
      }
    }
  }

  function takeFreeCell(freeCells) {
    const index = Math.floor(ROT.RNG.getUniform() * freeCells.length);
    const key = freeCells.splice(index, 1)[0];
    return key;
  }

  function posFromKey(key) {
    const parts = key.split(",");
    const x = parseInt(parts[0]);
    const y = parseInt(parts[1]);
    return [x, y];
  }

  function generateScenery(map, freeCells) {
    for (let i = 0; i < 100; i++) {
      if (freeCells.length) {
        const key = takeFreeCell(freeCells);
        map[key] = ROT.RNG.getItem("abcde");
      }
    }
  }

  function generateRooms(map, mapgen) {
    const rooms = mapgen.getRooms();
    for (let rm = 0; rm < rooms.length; rm++) {
      const room = rooms[rm];

      const l = room.getLeft() - 1;
      const r = room.getRight() + 1;
      const t = room.getTop() - 1;
      const b = room.getBottom() + 1;

      map[l + "," + t] = "╔";
      map[r + "," + t] = "╗";
      map[l + "," + b] = "╚";
      map[r + "," + b] = "╝";

      for (let i = room.getLeft(); i <= room.getRight(); i++) {
        const j = i + "," + t;
        const k = i + "," + b;
        if (noreplace.indexOf(map[j]) == -1) {
          map[j] = "═";
        }
        if (noreplace.indexOf(map[k]) == -1) {
          map[k] = "═";
        }
      }

      for (let i = room.getTop(); i <= room.getBottom(); i++) {
        const j = l + "," + i;
        const k = r + "," + i;
        if (noreplace.indexOf(map[j]) == -1) {
          map[j] = "║";
        }
        if (noreplace.indexOf(map[k]) == -1) {
          map[k] = "║";
        }
      }
    }
  }

  function drawTile(game, key, ignore) {
    const map = game.map;
    if (map[key]) {
      const parts = posFromKey(key);
      const monster = monsterAt(parts[0], parts[1]);
      const player = playerAt(parts[0], parts[1]);
      const display = game.display;
      const items = game.items;
      const draw = [map[key], items[key]];
      draw.push(monster && monster != ignore ? monster.character : null);
      draw.push(player && player != ignore ? player.character : null);
      display.draw(
        parts[0],
        parts[1],
        draw.filter((i) => i)
      );
    }
  }

  // both the player and monster initial position is set
  function createBeing(what, freeCells) {
    const key = takeFreeCell(freeCells);
    const pos = posFromKey(key);
    const being = what(pos[0], pos[1]);
    return being;
  }

  /******************
   *** the player ***
   ******************/

  // creates a player object with position, and stats
  function makePlayer(x, y) {
    return {
      // player's position
      _x: x,
      _y: y,
      character: "@",
      name: "you",
      // the player's stats
      stats: { hp: 10, xp: 0, gold: 0 },
      // the ROT.js scheduler calls this method when it is time
      // for the player to act
      act: () => {
        Game.engine.lock();
        if (!Game["arrowListener"]) {
          document.addEventListener("arrow", arrowEventHandler);
          Game.arrowListener = true;
        }
      },
    };
  }

  // this method gets called by the `movePlayer` function
  function checkItem(entity) {
    const key = entity._x + "," + entity._y;
    if (key == Game.door) {
      if(count < 5) {
        nextStage(Game, ++count, Game.player.stats);
      } else {
      win();
      }
    } else if (key == Game.stairs) {
      nextStage(Game, ++count, Game.player.stats);
    }else if (Game.items[key] == "g") {
      Game.player.stats.gold += 1;
      renderStats(Game.player.stats);
      toast("You found gold!");
      sfx["win"].play();
      delete Game.items[key];
    }
    drawTile(Game, key);
  }

  function movePlayer(dir) {
    const p = Game.player;
    return movePlayerTo(p._x + dir[0], p._y + dir[1]);
  }

  function movePlayerTo(x, y) {
    const p = Game.player;

    const newKey = x + "," + y;
    if (walkable.indexOf(Game.map[newKey]) == -1) {
      return;
    }

    // check if we've hit the monster
    const hitMonster = monsterAt(x, y);
    if (hitMonster) {
      //combat(p, hitMonster);
      setTimeout(function () {
        Game.engine.unlock();
      }, 250);
    } else {
      hideToast();

      drawTile(Game, p._x + "," + p._y, p);

      // update the player's coordinates
      p._x = x;
      p._y = y;

      // re-draw the player
      for (let key in Game.map) {
        drawTile(Game, key);
      }
      // re-locate the game screen to center the player
      rescale(x, y, Game);
      window.removeEventListener("arrow", arrowEventHandler);
      Game.engine.unlock();
      sfx["step"].play();
      // check if the player stepped on an item
      checkItem(p);
    }
  }

  /*******************
   *** The monster ***
   *******************/

  // basic ROT.js entity with position and stats
  function makeMonster(x, y) {
    return {
      // monster position
      _x: x,
      _y: y,
      character: "M",
      name: "Orc",
      stats: { hp: 3 },
      // called by the ROT.js scheduler
      act: monsterAct,
    };
  }

  function monsterAct() {
    const m = this;
    const p = Game.player;
    const map = Game.map;
    const display = Game.display;

    const passableCallback = function (x, y) {
      return walkable.indexOf(map[x + "," + y]) != -1;
    };
    const astar = new ROT.Path.AStar(p._x, p._y, passableCallback, {
      topology: 4,
    });
    const path = [];
    const pathCallback = function (x, y) {
      path.push([x, y]);
    };
    astar.compute(m._x, m._y, pathCallback);

    path.shift();
    if (path.length <= 1) {
      Game.playerAllowedToMove = false;
      Game.engine.lock();
      combat(m, p);
    } else {
      drawTile(Game, m._x + "," + m._y, m);
      m._x = path[0][0];
      m._y = path[0][1];
      drawTile(Game, m._x + "," + m._y);
    }
  }

  function monsterAt(x, y) {
    if (Game.monsters && Game.monsters.length) {
      for (let mi = 0; mi < Game.monsters.length; mi++) {
        const m = Game.monsters[mi];
        if (m && m._x == x && m._y == y) {
          return m;
        }
      }
    }
  }

  function playerAt(x, y) {
    return Game.player && Game.player._x == x && Game.player._y == y
      ? Game.player
      : null;
  }

  // if the monster is dead remove it from the game
  function checkDeath(m) {
    if (m.stats.hp <= 0) {
      if (m == Game.player) {
        toast("You died!");
        lose();
      } else {
        const key = m._x + "," + m._y;
        removeMonster(m);
        sfx["kill"].play();
        return true;
      }
    }
  }

  // remove a monster from the game
  function removeMonster(m) {
    const key = m._x + "," + m._y;
    Game.scheduler.remove(m);
    Game.monsters = Game.monsters.filter((mx) => mx != m);
    drawTile(Game, key);
  }

  /******************************
   *** combat/win/lose events ***
   ******************************/
  // this is how the player fights a monster
  function checkSolution(solution, answer, hitter, receiver) {
    console.log("Click: " + solution + " Antwort: " + answer);
    if (solution == answer) {
      hitter.stats.hp -= 1;
      sfx["hit"].play();
      if (checkDeath(hitter)) {
        Game.player.stats.xp += 1;
        showScreen("game");
        Game.playerAllowedToMove = true;
        Game.engine.unlock();
      } else {
        combat(hitter, receiver);
      }
      checkDeath(hitter);
    } else {
      sfx["miss"].play();
      //showScreen("game");
      //Game.playerAllowedToMove = true;
      //Game.engine.unlock();
    }
  }

  function setupButtons(answerValue, hitter, receiver) {
    const randomValue = (min, max) =>
      Math.floor(Math.random() * (max - min)) + min;
    let randomVar = randomValue(1, 4);
    if (randomVar == 1) {
      document.getElementById("answer1").innerHTML = `${answerValue}`;
      document.getElementById("answer2").innerHTML = `${
        answerValue + randomValue(1, 4)
      }`;
      document.getElementById("answer3").innerHTML = `${
        answerValue - randomValue(1, 4)
      }`;
    } else if (randomVar == 2) {
      document.getElementById("answer1").innerHTML = `${
        answerValue + randomValue(1, 4)
      }`;
      document.getElementById("answer2").innerHTML = `${answerValue}`;
      document.getElementById("answer3").innerHTML = `${
        answerValue - randomValue(1, 4)
      }`;
    } else {
      document.getElementById("answer1").innerHTML = `${
        answerValue - randomValue(1, 4)
      }`;
      document.getElementById("answer2").innerHTML = `${
        answerValue + randomValue(1, 4)
      }`;
      document.getElementById("answer3").innerHTML = `${answerValue}`;
    }
    document.getElementById("answer1").addEventListener("click", async() => {
      checkSolution(document.getElementById("answer1").innerText, answerValue, hitter, receiver);
    }, {once: true});
    document.getElementById("answer2").addEventListener("click", async() => {
      checkSolution(document.getElementById("answer2").innerText, answerValue, hitter, receiver);
    }, {once: true});
    document.getElementById("answer3").addEventListener("click", async() => {
      checkSolution(document.getElementById("answer3").innerText, answerValue, hitter, receiver);
    }, {once: true});
  }

  function combat(hitter, receiver) {
    const randomValue = (min, max) =>
      Math.floor(Math.random() * (max - min)) + min;
    let [num1, num2] = [randomValue(1, 10), randomValue(1, 10)];
    const answerValue = eval(`${num1} * ${num2}`);
    document.getElementById("question").innerHTML = `${num1} * ${num2} = ? `;
    setupButtons(answerValue, hitter, receiver);
    showScreen("combat");
    checkDeath(receiver);
    renderStats(Game.player.stats);
  }

  // this gets called when the player wins the game
  function win() {
    Game.engine.lock();
    for (let i = 0; i < 5; i++) {
      setTimeout(function () {
        sfx["win"].play();
      }, 100 * i);
    }
    // set our stats for the end screen
    setEndScreenValues(Game.player.stats.xp, Game.player.stats.gold);
    // tear down the game
    destroy(Game);
    showScreen("win");
  }

  // this gets called when the player loses the game
  function lose() {
    Game.engine.lock();
    // change the player into a tombstone tile
    const p = Game.player;
    p.character = "T";
    drawTile(Game, p._x + "," + p._y);
    const ghost = createGhost([p._x, p._y]);
    removeListeners(Game);
    sfx["lose"].play();
    setTimeout(function () {
      setEndScreenValues(Game.player.stats.xp, Game.player.stats.gold);
      // tear down the game
      destroy(Game);
      showScreen("lose");
    }, 2000);
  }

  /************************************
   *** graphics, UI & browser utils ***
   ************************************/

  const clickevt = !!("ontouchstart" in window) ? "touchstart" : "click";

  const $ = document.querySelector.bind(document);
  const $$ = document.querySelectorAll.bind(document);
  NodeList.prototype.forEach = Array.prototype.forEach;

  // this code resets the ROT.js display canvas
  function resetCanvas(el) {
    $("#canvas").innerHTML = "";
    $("#canvas").appendChild(el);
    window.onkeydown = keyHandler;
    window.onkeyup = arrowStop;
    if (useArrows) {
      document.ontouchend = arrowStop;
    }
    showScreen("game");
  }

  function rescale(x, y, game) {
    const c = $("canvas");
    const scale = window.innerWidth < 600 ? scaleMobile : scaleMonitor;
    const offset = game.touchScreen ? touchOffsetY : 0;
    const tw =
      x * -tileOptions.tileWidth +
      (tileOptions.width * tileOptions.tileWidth) / 2 +
      -4;
    const th =
      y * -tileOptions.tileHeight +
      (tileOptions.height * tileOptions.tileHeight) / 2 +
      offset;
    if (canvas) {
      canvas.style.transition = "transform 0.5s ease-out 0s";
      if (game.display) {
        game.display
          .getContainer()
          .getContext("2d").imageSmoothingEnabled = false;
      }
      canvas.style.transform =
        "scale(" +
        scale +
        ") " +
        "translate3d(" +
        Math.floor(tw) +
        "px," +
        Math.floor(th) +
        "px,0px)";
    }
  }

  function removeListeners(game) {
    if (game.engine) {
      game.lastArrow = null;
      clearInterval(game.arrowInterval);
      game.arrowInterval = null;
      game.engine.lock();
      game.scheduler.clear();
      window.removeEventListener("arrow", arrowEventHandler);
      game.arrowListener = false;
      window.onkeydown = null;
      window.onkeyup = null;
    }
  }

  // hides all screens and shows the requested screen
  function showScreen(which, ev) {
    ev && ev.preventDefault();
    const el = $("#" + which);
    const actionbutton = $("#" + which + ">.action");
    document.querySelectorAll(".screen").forEach(function (s) {
      s.classList.remove("show");
      s.classList.add("hide");
    });
    el.classList.remove("hide");
    el.classList.remove("show");
    void el.offsetHeight; // trigger CSS reflow
    el.classList.add("show");
    if (actionbutton) {
      actionbutton.focus();
    }
  }

  // set the end-screen message
  function setEndScreenValues(xp, gold) {
    $$(".xp-stat").forEach((el) => (el.textContent = Math.floor(xp)));
    $$(".gold-stat").forEach((el) => (el.textContent = gold));
  }

  // updates the stats listed at the bottom of the screen
  function renderStats(stats) {
    const st = $("#hud");
    st.innerHTML = "";
    for (let s in stats) {
      attach(st, el("span", {}, [s.toUpperCase() + ": " + stats[s]]));
    }
  }

  // creates the ghost sprite when the player dies
  function createGhost(pos) {
    const tw = tileOptions.tileWidth;
    const th = tileOptions.tileHeight;
    const left = "left:" + pos[0] * tw + "px;";
    const top = "top:" + pos[1] * th + "px;";
    const ghost = el("div", {
      className: "sprite ghost free float-up",
      style: left + top,
    });
    ghost.onanimationend = function () {
      rmel(ghost);
    };
    return attach($("#canvas"), ghost);
  }

  function battleMessage(messages) {
    const components = messages.reduce(function (msgs, m) {
      return msgs
        .concat(
          m.split(" ").map(function (p) {
            const match = p.match(/hit|miss/);
            return el("span", { className: match ? match[0] : "" }, [p, " "]);
          })
        )
        .concat(el("br", {}));
    }, []);
    return el("span", {}, components);
  }

  function toast(message) {
    const m = $("#message");
    if (
      Game.scheduler._current == Game.player ||
      m.className.indexOf("show") == -1
    ) {
      m.innerHTML = "";
    }
    m.classList.remove("fade-out");
    m.classList.add("show");
    if (typeof message == "string") {
      m.appendChild(el("span", {}, [message]));
    } else {
      m.appendChild(message);
    }
  }

  function hideToast(instant) {
    const m = $("#message");
    if (instant) {
      m.classList.remove("show");
      m.classList.remove("fade-out");
      m.innerHTML = "";
    } else if (m.className.match("show")) {
      m.classList.remove("show");
      m.classList.add("fade-out");
      m.onanimationend = function () {
        m.classList.remove("fade-out");
        m.innerHTML = "";
      };
    }
  }

  // create an HTML element
  function el(tag, attrs, children) {
    const node = document.createElement(tag);
    for (a in attrs) {
      node[a] = attrs[a];
    }
    (children || []).forEach(function (c) {
      if (typeof c == "string") {
        node.appendChild(document.createTextNode(c));
      } else {
        attach(node, c);
      }
    });
    return node;
  }

  // add an HTML element to a parent node
  function attach(node, el) {
    node.appendChild(el);
    return el;
  }

  // remove an element from the dom
  function rmel(node) {
    node.parentNode.removeChild(node);
  }

  /*************************
   *** UI event handlers ***
   *************************/

  function keyHandler(ev) {
    const code = ev.keyCode;
    if (code == 187 || code == 189) {
      ev.preventDefault();
      return;
    }
    if (code == 70 && ev.altKey && ev.ctrlKey && ev.shiftKey) {
      document.body.requestFullscreen();
      console.log("Full screen pressed.");
      return;
    }
    if (code == 73) {
      toggleInventory(ev, true);
      return;
    }
    if (code == 190) {
      Game.engine.unlock();
      return;
    } // skip turn
    if (!(code in keyMap)) {
      return;
    }
    const dir = ROT.DIRS[8][keyMap[code]];
    if (Game.display) {
      ev.preventDefault();
    }
    if(Game.playerAllowedToMove) {
      arrowStart(dir);
    }
  }

  function arrowStart(dir) {
    const last = Game.lastArrow;
    Game.lastArrow = dir;
    if (!last) {
      document.dispatchEvent(new Event("arrow"));
      if (Game.arrowInterval) {
        clearInterval(Game.arrowInterval);
      }
      Game.arrowInterval = setInterval(function () {
        document.dispatchEvent(new Event("arrow"));
      }, turnLengthMS);
    }
  }

  function arrowStop(ev) {
    clearInterval(Game.arrowInterval);
    Game.arrowInterval = null;
    Game.lastArrow = null;
  }

  function arrowEventHandler() {
    if (Game.lastArrow) {
      movePlayer(Game.lastArrow);
    } else {
      arrowStop();
    }
  }

  function startGame(ev) {
    showScreen("game");
    sfx["rubber"].play();
    init(Game);
  }

  function handleMenuChange(which, ev) {
    ev.preventDefault();
    const choice = which.getAttribute("value");
    showScreen(choice);
    sfx["choice"].play();
  }

  function hideModal(ev) {
    ev.preventDefault();
    showScreen("title");
    sfx["hide"].play();
  }

  function cleanup() {
    destroy(Game);
    $("#play").removeEventListener(clickevt, startGame);
  }

  /***************
   *** Startup ***
   ***************/

  // this code is called at load time and sets the game title
  document.querySelectorAll(".game-title-text").forEach(function (t) {
    t.textContent = gametitle;
  });

  // listen for the start game button
  $("#play").addEventListener(clickevt, startGame);
  
  if (w["rbb"]) {
    w["rbb"].cleanup();
  } else {
    $("#plate").addEventListener(
      "animationend",
      showScreen.bind(null, "title")
    );
    document.querySelectorAll("#options #menu input").forEach(function (el) {
      el.addEventListener("click", handleMenuChange.bind(null, el));
    });
    document.querySelectorAll(".modal button.action").forEach(function (el) {
      el.addEventListener(clickevt, hideModal);
    });
  }

  w["rbb"] = Game;
})(window);
</script>
</html>
