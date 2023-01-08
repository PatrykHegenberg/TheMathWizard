<?php
require 'functions.php';
require 'Database.php';
require 'router.php';
require 'Response.php';

$username = 'MatheApp';
$password = 'password';
$config = require('config.php');
$db = new Database($config['database'], $username, $password);

//dd($posts);
