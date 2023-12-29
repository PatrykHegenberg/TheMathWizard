# The Math Wizard

The Math Wizard is a browser game that helps children automate the 1x1. It acts as a dungeon crawler game in which children can fight monsters by solving multiplication problems.

## Requirements

To run the game, you need Docker and Docker-Compose. Make sure that these are installed and configured on your system.

## Installation

1. clone the repository with `git clone https://github.com/PatrykHegenberg/TheMathWizard.git`.
2. change to the project directory with `cd TheMathWizard`.
3. run `docker-compose up --build` to install and start the game.

Once the installation is complete, you can access the game via your web browser under `localhost:8080` or the computer name.

## Usage

To create a new account, go to `localhost:8080/signup` in the browser. After signing up, you can start the game and begin fighting monsters and solving multiplication tasks. Your progress will be saved persistently on the hard disk of the host computer.

## License

This project is licensed under the MIT license. For more information, see the LICENSE file.

## Acknowledgments

This project uses the following resources:
- [ROT.js](https://github.com/ondras/rot.js/) (BSD-Lizenz)
- [Micro Rogue tileset](https://kenney.nl/assets/micro-roguelike) von Kenney.nl (CC0 1.0 Universelle Lizenz)
- [NES.css](https://nostalgic-css.github.io/NES.css/) (MIT Lizenz)
- [sfxr.me](https://www.sfxr.me/) (Öffentliches Domain)
- [Pixel Coin Bild](https://opengameart.org/content/pixel-coins) (CC-BY 3.0 Lizenz)
- [Roguelike-Browser-Boilerplate](https://github.com/chr15m/roguelike-browser-boilerplate)
