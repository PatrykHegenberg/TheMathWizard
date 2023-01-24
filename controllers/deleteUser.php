<?php
$config = require('config.php');
$db = new Database($config['database'], $config['username'], $config['password']);

session_start();
if (isset($_POST['delete'])){
$db->delete($_POST['username']);
header("Location: /profile");
}
