<?php
$heading = "Delete";
$config = require('config.php');
$db = new Database($config['database'], $config['username'], $config['password']);

session_start();
$db->delete($_SESSION['username']);
session_destroy();
header("Location: /");
exit;
