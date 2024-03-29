(function (w) {
  var playerStats = document.getElementById("playerStats").innerHTML;

  const convertData = (stats) => {
    var player = {};
    stats = stats.replace("'", "").replace("{","").replace("}","");
    stats = stats.split(",");
    for (let i = 0; i < stats.length; i++) {
      var parts = stats[i].split(":");
      if (isNaN(Number(parts[1].replace("'","").replace('"','').replace('"','')))) {
      player[parts[0].replace("'","").replace('"','').replace('"','')] = parts[1].replace("'","").replace('"','').replace('"','');
      } else {
        player[parts[0].replace("'","").replace('"','').replace('"','')] = Number(parts[1].replace("'","").replace('"','').replace('"',''));
      }
    }
    return player;
  }

  var statsOfPlayer = convertData(playerStats);
  let count = 1;
  // game title
  const gametitle = "The Math Wizard";

  /*****************
   *** resources ***
   *****************/

  // This tileset is from 0x72
  // It's the "16x16 DungeonTileset" tileset

  const tileSet = document.createElement("img");
  tileSet.src = "./../images/16x16DungeonTileset.png";

  const tileOptions = {
    layout: "tile",
    bg: "transparent",
    tileWidth: 16,
    tileHeight: 16,
    tileSet: tileSet,
    tileMap: {
      "@": [144, 224], // player
      ".": [32, 48], // floor
      "M": [32, 160], // normal orc
      "a": [0, 160], // small orc
      "b": [80, 176], // Boss
      "g": [272, 144], // gold
      "p": [192, 176], // potion
      "T": [112, 160], // tombstone
      "╔": [336, 160], // room corner
      "╗": [368, 160], // room corner
      "╝": [368, 192], // room corner
      "╚": [336, 192], // room corner
      "═": [352, 160], // room edge
      "║": [336, 176], // room edge
      "o": [40, 72], // room corner
      "D": [416, 176], //Door to win
      "s": [288, 112], //stairs to next Stage
    },
    width: 25,
    height: 40,
  };

  const touchOffsetY = -20; // move the center by this much
  const scaleMonitor = 3; // scale computer screens by this much
  const turnLengthMS = 200; // shortest time between turns

  // these map tiles are walkable
  const walkable = [".", "g", "D", "s"];

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
    87: 0, //38->Hoch
    33: 1,
    68: 2, //30->Rechts
    34: 3,
    83: 4, //40->Runter
    35: 5,
    65: 6, //37->Links
    36: 7,
  };

  /*****************
   *** game code ***
   *****************/

  // based on the original tutorial by Ondřej Žára
  // www.roguebasin.com/index.php?title=Rot.js_tutorial,_part_1

  const Game = {
    display: null,
    map: {},
    items: {},
    engine: null,
    scheduler: null,
    player: null,
    monsters: null,
    door: null,
    lastArrow: null, 
    arrowInterval: null, 
    arrowListener: null, 
    cleanup: cleanup,
    playerAllowedToMove: true,
  };

  const init = (game) => {
    game.map = {};
    game.items = {};
    game.display = new ROT.Display(tileOptions);
    resetCanvas(game.display.getContainer());

    generateMap(game, count);

    game.scheduler = new ROT.Scheduler.Simple();
    game.scheduler.add(game.player, true);
    game.monsters.map((m) => game.scheduler.add(m, true));

    renderStats(game.player.stats);

    game.engine = new ROT.Engine(game.scheduler);
    game.engine.start();
    count = 1;
  }

  const nextStage = (game, stage, stats) => {
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

    game.scheduler = new ROT.Scheduler.Simple();
    game.scheduler.add(game.player, true);
    game.monsters.map((m) => game.scheduler.add(m, true));

    game.player.stats = stats;
    renderStats(game.player.stats);

    game.engine = new ROT.Engine(game.scheduler);
    game.engine.start();;
  }

  const destroy = (game) => {
    removeListeners(game);

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

    hideToast(true);
    showScreen("title");
  }

  function generateMap(game, stage) {
    const digger = new ROT.Map.Digger(tileOptions.width, tileOptions.height);
    const freeCells = [];
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
    generateRooms(game.map, digger);

    game.player = createBeing(makePlayer, freeCells);
    game.monsters = []
    if (stage <= 4) {
      for ( var i= 0; i<= stage; i++) {
        game.monsters.push(createBeing(makeMonster, freeCells));
      }
    } else {
      game.monsters.push(createBeing(makeMonster, freeCells));
    }

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
          game.stairs = freeCells[freeCells.length - 1];
          game.items[freeCells[freeCells.length - 1]] = "s";
        } else {
          game.door = freeCells[freeCells.length - 1];
          game.items[freeCells[freeCells.length - 1]] = "D";
        }
      } else {
        game.items[key] = "g";
      }
    }
  }

  const takeFreeCell = (freeCells) => {
    const index = Math.floor(ROT.RNG.getUniform() * freeCells.length);
    const key = freeCells.splice(index, 1)[0];
    return key;
  }

  const posFromKey = (key) => {
    const parts = key.split(",");
    const x = parseInt(parts[0]);
    const y = parseInt(parts[1]);
    return [x, y];
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

  function createBeing(what, freeCells) {
    if (what == makePlayer) {
      const pos = posFromKey(freeCells[0]);
      const being = what(pos[0], pos[1]);
      return being; 
    } else {
    const key = takeFreeCell(freeCells);
    const pos = posFromKey(key);
    const being = what(pos[0], pos[1]);
    return being;
    }
  }

  /******************
   *** the player ***
   ******************/

  const makePlayer = (x, y) => {
    return {
      _x: x,
      _y: y,
      character: "@",
      name: statsOfPlayer['username'].replace('"',''),
      stats: { hp: 10, xp: 0, gold: 0 },
      act: () => {
        Game.engine.lock();
        if (!Game["arrowListener"]) {
          document.addEventListener("arrow", arrowEventHandler);
          Game.arrowListener = true;
        }
      },
    };
  }
  const checkItem = (entity) => {
    const key = entity._x + "," + entity._y;
    if (key == Game.door) {
      (count < 5 ? nextStage(Game, ++count, Game.player.stats) : win());
    } else if (key == Game.stairs && Game.monsters.length == 0) {
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
  const movePlayer = (dir) => {
    const p = Game.player;
    return movePlayerTo(p._x + dir[0], p._y + dir[1]);
  }

  const movePlayerTo = (x, y) => {
    const p = Game.player;

    const newKey = x + "," + y;
    if (walkable.indexOf(Game.map[newKey]) == -1) {
      return;
    }

    const hitMonster = monsterAt(x, y);
    if (hitMonster) {
      setTimeout(function () {
        Game.engine.unlock();
      }, 250);
    } else {
      hideToast();

      drawTile(Game, p._x + "," + p._y, p);

      p._x = x;
      p._y = y;

      for (let key in Game.map) {
        drawTile(Game, key);
      }
      rescale(x, y, Game);
      window.removeEventListener("arrow", arrowEventHandler);
      Game.engine.unlock();
      sfx["step"].play();
      checkItem(p);
    }
  }

  /*******************
   *** The monster ***
   *******************/

  function makeMonster(x, y) {
    if (count === 5) {
      return {
        _x: x,
        _y: y,
        character: "b",
        name: "Necromancer",
        stats: {hp: 10},
        act: monsterAct,
      }
    } else {
      let randomMonster = Math.floor(Math.random() * 2);
      if (randomMonster === 1) {
        return {
          _x: x,
          _y: y,
          character: "M",
          name: "Orc",
          stats: { hp: 4 },
          act: monsterAct,
        };
      } else {
        return {
          _x: x,
          _y: y,
          character: "a",
          name: "Kleiner Orc",
          stats: { hp: 3 },
          act: monsterAct,
        };
      }
    }
    
  }

  function monsterAct() {
    const m = this;
    const p = Game.player;
    const map = Game.map;
    const display = Game.display;

    const passableCallback = (x, y) => {
      return walkable.indexOf(map[x + "," + y]) != -1;
    };
    const astar = new ROT.Path.AStar(p._x, p._y, passableCallback, {
      topology: 4,
    });
    const path = [];
    const pathCallback = (x, y) => {
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

  const playerAt = (x, y) => {
    return Game.player && Game.player._x == x && Game.player._y == y
      ? Game.player
      : null;
  }

  function checkDeath(m) {
    if (m.stats.hp <= 0) {
      if (m == Game.player) {
        toast("You died!");
        lose();
      } else {
        const key = m._x + "," + m._y;
        removeMonster(m);
        Game.player.stats.xp += 1;
        sfx["kill"].play();
        return true;
      }
    }
  }

  function removeMonster(m) {
    const key = m._x + "," + m._y;
    Game.scheduler.remove(m);
    Game.monsters = Game.monsters.filter((mx) => mx != m);
    drawTile(Game, key);
  }

  /******************************
   *** combat/win/lose events ***
   ******************************/
  const checkSolution = (solution, answer) => {
    return solution == answer;
  }

   async function setupButtons(answerValue) {
    let operators = ["+", "-"];
    let randomOperator = operators[Math.floor(Math.random() * operators.length)];
    const randomValue = (min, max) =>
      Math.floor(Math.random() * (max - min)) + min;
    let randomVar = randomValue(1, 4);
    let random1 = eval(`${answerValue}${randomOperator} ${randomValue(1, 4)}`);
    let random2 = eval(`${answerValue}${randomOperator} ${randomValue(1, 4)}`);
    if (random1 === random2){
      random2 += 1;
      if (random2 === answerValue) {
        random2 += 1;
      }
    }
    if (random1 < 1) {
      random1 = 1 + randomValue(0,2);
    } else if (random2 < 1) {
      random2 = 1 + randomValue(0, 2);
    }
    if (randomVar === 1) {
      document.getElementById("answer1").innerHTML = `${answerValue}`;
      document.getElementById("answer2").innerHTML = random1;
      document.getElementById("answer3").innerHTML = random2;
    } else if (randomVar === 2) {
      document.getElementById("answer1").innerHTML = random1;
      document.getElementById("answer2").innerHTML = `${answerValue}`;
      document.getElementById("answer3").innerHTML = random2;
    } else {
      document.getElementById("answer1").innerHTML = random1;
      document.getElementById("answer2").innerHTML = random2;
      document.getElementById("answer3").innerHTML = `${answerValue}`;
    }
    showScreen("combat");
    return new Promise((resolve) => {
      const button1 = document.getElementById("answer1");
      const button2 = document.getElementById("answer2");
      const button3 = document.getElementById("answer3");
      button1.addEventListener('click', () => {
        resolve(button1.innerText);
      });
      button2.addEventListener('click', () => {
        resolve(button2.innerText);
      });
      button3.addEventListener('click', () => {
        resolve(button3.innerText);
      });
    });
  }

  async function combat(hitter, receiver) {
    let msg = [];
    const randomValue = (min, max) =>
      Math.floor(Math.random() * (max - min)) + min;
    let num1, num2;
    if (statsOfPlayer['level'] > 10) {
      [num1, num2] = [randomValue(1, 10), randomValue(1, 10)];
    } else {
      num1 = statsOfPlayer['level'];
      num2 = randomValue(1, 10);
    }
    const answerValue = eval(`${num1} * ${num2}`);
    document.getElementById("question").innerHTML = `${num1} * ${num2} = ? `;
    const clicked = await setupButtons(answerValue);
    let fight = checkSolution(clicked, answerValue);
    if(fight) {
      msg.push(`${Game.player.name} haut ${hitter.name}.`);
      hitter.stats.hp -= 1;
      sfx["hit"].play();
    } else {
      sfx["miss"].play();
      msg.push(`${hitter.name} haut ${Game.player.name}.`);
      Game.player.stats.hp -= 1;
    }
    if(msg) {
      toast(battleMessage(msg));
    }
    checkDeath(hitter);
    checkDeath(receiver);
    showScreen("game");
    renderStats(Game.player.stats);
    Game.playerAllowedToMove = true;
    Game.engine.unlock();
  }

  const win = () => {
    Game.engine.lock();
    Game.player.stats.xp += 10;
    for (let i = 0; i < 5; i++) {
      setTimeout(function () {
        sfx["win"].play();
      }, 100 * i);
    }
    setEndScreenValues(Game.player.stats.xp, Game.player.stats.gold);
    destroy(Game);
    showScreen("win");
  }

  const lose = () => {
    Game.engine.lock();
    const p = Game.player;
    p.character = "T";
    drawTile(Game, p._x + "," + p._y);
    removeListeners(Game);
    sfx["lose"].play();
    setTimeout(function () {
      setEndScreenValues(Game.player.stats.xp, Game.player.stats.gold);
      destroy(Game);
      showScreen("lose");
    }, 2000);
  }

  /************************************
   *** graphics, UI & browser utils ***
   ************************************/

  const clickevt = "click";

  const $ = document.querySelector.bind(document);
  const $$ = document.querySelectorAll.bind(document);
  NodeList.prototype.forEach = Array.prototype.forEach;

  const resetCanvas = (el) => {
    $("#canvas").innerHTML = "";
    $("#canvas").appendChild(el);
    window.onkeydown = keyHandler;
    window.onkeyup = arrowStop;
    showScreen("game");
  }

  const rescale = (x, y, game) => {
    const c = $("canvas");
    const scale = scaleMonitor;
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

  const removeListeners = (game) => {
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

  const showScreen = (which, ev) => {
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

  const setEndScreenValues = (xp, gold) => {
    $$(".xp-stat").forEach((el) => (el.textContent = Math.floor(xp)));
    $$(".gold-stat").forEach((el) => (el.textContent = gold));

    statsOfPlayer["coins"] += gold;
    statsOfPlayer["username"] = Game.player.name.trim().replace('"','');

    if ((statsOfPlayer['xp'] + xp) > 150) {
      statsOfPlayer["level"] = Number(statsOfPlayer["level"]) + 1;
      statsOfPlayer["xp"] += xp;
      statsOfPlayer["xp"] -= 150;
    } else {
      statsOfPlayer["level"] = Number(statsOfPlayer["level"]);
      statsOfPlayer["xp"] += xp;
    }

    var json = JSON.stringify(statsOfPlayer);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/updateData", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
    }
    }
    xhr.send(json);
  }

  const renderStats = (stats) => {
    const st = $("#hud");
    st.innerHTML = "";
    for (let s in stats) {
      attach(st, el("span", {}, [s.toUpperCase() + ": " + stats[s]]));
    }
  }

  const battleMessage = (messages) => {
    const components = messages.reduce(function (msgs, m) {
      return msgs
        .concat(
          m.split(" ").map(function (p) {
            const match = p.match(/haut|miss/);
            return el("span", { className: match ? match[0] : "" }, [p, " "]);
          })
        )
        .concat(el("br", {}));
    }, []);
    return el("span", {}, components);
  }

  const toast = (message) => {
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

  const hideToast = (instant) => {
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

  const el = (tag, attrs, children) => {
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

  const attach = (node, el) => {
    node.appendChild(el);
    return el;
  }

  const rmel = (node) => {
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

  document.querySelectorAll(".game-title-text").forEach(function (t) {
    t.textContent = gametitle;
  });

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
