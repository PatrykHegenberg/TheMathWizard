<?php
$heading = "profile";
$username = "MatheApp";
$password = "password";
$config = require('config.php');
$db = new Database($config['database'], $username, $password);

session_start();
if(!isset($_SESSION["username"])){
  header("Location: /");
  exit;
}

require "views/profile.view.php";
