<?php
$heading = "Delete";
$username = "MatheApp";
$password = "password";
$config = require('config.php');
$db = new Database($config['database'], $username, $password);

session_start();
$db->query("DELETE FROM user WHERE username = :user", ["user" => $_SESSION['username']]);
session_destroy();
header("Location: /");
exit;
