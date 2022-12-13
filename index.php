<?php
require 'functions.php';
require 'Database.php';
//require 'router.php';
$username = 'appUser';
$password = 'password';
$config = require('config.php');
$db = new Database($config['database'], $username, $password);
$posts = $db->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);

dd($posts);