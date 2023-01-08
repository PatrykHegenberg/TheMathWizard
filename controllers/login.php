<?php
$heading = "Login";
$username = "MatheApp";
$password = "password";
$config = require('config.php');
$db = new Database($config['database'], $username, $password);

if (isset($_POST["submit"])) {
  $stmt = $db->query("SELECT * FROM user WHERE username = :user", ['user' => $_POST["username"]])->get();
  $count = sizeof($stmt);
  if ($count == 1) {
    $stmt = $stmt[0];;
    
    if (password_verify($_POST['password'], $stmt["password"])) {
      session_start();
      $_SESSION["username"] = $stmt['username'];
      $_SESSION["level"] = $stmt['level'];
      $_SESSION["xp"] = $stmt['xp'];
      $_SESSION["coins"] = $stmt['coins'];
      $_SESSION["lesson_count"] = $stmt['lesson_count'];

      header("Location: /profile");
    } else {
      echo "Anmeldung fehlgeschlagen!";
    }
  } else {
    echo "Anmeldung fehlgeschlagen!";
  }
}

   require "views/login.view.php";
