<?php
  $heading = "Game";
  $username = 'MatheApp';
  $password = 'password';
  $config = require('config.php');
  $db = new Database($config['database'], $username, $password);
  session_start();
    if(!isset($_SESSION["username"])){
    header("Location: /");
    exit;
  }
  $stats = $db->getPlayerStats($_SESSION['username']);
  require "views/game.view.php";
