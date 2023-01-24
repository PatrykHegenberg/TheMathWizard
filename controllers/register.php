<?php
  $heading = "Register";
  require 'Validator.php';
  $config = require('config.php');
  $db = new Database($config['database'], $config['username'], $config['password']);
  
if (isset($_POST["submit"])) {
  $db->register($_POST);
}

  require "views/register.view.php";
