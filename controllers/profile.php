<?php
$heading = "profile";
$config = require('config.php');
$db = new Database($config['database'], $config['username'], $config['password']);

session_start();
if(!isset($_SESSION["username"])){
  header("Location: /");
  exit;
}
$users = $db->getUsers("admin");
$stats = $db->getPlayerStats($_SESSION['username']);
require "views/profile.view.php";
