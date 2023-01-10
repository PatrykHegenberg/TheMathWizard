<?php
  $username = 'MatheApp';
  $password = 'password';
  $config = require('config.php');
  $db = new Database($config['database'], $username, $password);
$data = json_decode(file_get_contents("php://input"), true);
dd($data);
  $db->update($data);
