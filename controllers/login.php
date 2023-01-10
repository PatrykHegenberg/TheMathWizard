<?php
$heading = "Login";
$username = "MatheApp";
$password = "password";
$config = require('config.php');
$db = new Database($config['database'], $username, $password);

if (isset($_POST["submit"])) {
  $db->login([$_POST["username"], $_POST["password"]]);
}

   require "views/login.view.php";
