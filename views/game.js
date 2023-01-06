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
  tileSet.src = "colored_tilemap_packed.png";

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