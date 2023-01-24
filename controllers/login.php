<?php
$heading = "Login";
$config = require('config.php');
$db = new Database($config['database'], $config['username'], $config['password']);

if (isset($_POST["submit"])) {
  $db->login([$_POST["username"], $_POST["password"]]);
}
if (isset($_POST["remember"])) {
  setcookie("user", $_POST["username"], time() + (86400 * 30), "/");
}
   require "views/login.view.php";
