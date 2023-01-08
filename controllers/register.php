<?php
  $heading = "Register";
  require 'Validator.php';
  $username = 'MatheApp';
  $password = 'password';
  $config = require('config.php');
  $db = new Database($config['database'], $username, $password);
  
  if (isset($_POST["submit"])) {
  $stmt = $db->query("SELECT * FROM user WHERE username = :user", ['user' => $_POST['Username']])->get();
  $count = sizeof($stmt);
  if($count == 0 && Validator::string($_POST['Username'], 1, 255)){
    $checkEmail = $db->query("SELECT * FROM user WHERE email = :email", ['email' => $_POST['Email-Adresse']])->find();
    if(!$checkEmail && Validator::string($_POST['Email-Adresse'], 1, 255)) {
      if($_POST["Passwort"] == $_POST["pw2"] && Validator::string($_POST['Passwort'], 8, 255)) {
    //Username ist frei
      //User anlegen
        $hash = password_hash($_POST["Passwort"], PASSWORD_BCRYPT);
        $db->query("INSERT INTO user (username, vorname, nachname, email, password, lesson_count, level, xp, coins) VALUES (
          :username, :vorname, :nachname, :email, :password, :lesson_count, :level, :xp, :coins )", [
            'username' => $_POST['Username'],
            'vorname' => $_POST['Vorname'],
            'nachname' => $_POST['Nachname'],
            'email' => $_POST['Email-Adresse'],
            'password' => $hash,
            'lesson_count' => 0,
            'level' => 1,
            'xp' => 0,
            'coins' => 0
          ]);
        header("Location: /login");
      } else {
        echo "Die Passwörter stimmen nicht überein";
      }
  } else {
    echo "Der Username ist bereits vergeben";
  }
}
}

  require "views/register.view.php";
