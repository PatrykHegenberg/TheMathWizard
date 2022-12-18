<?php
require 'functions.php';
require 'Database.php';
require 'router.php';
require 'Response.php';
//$username = 'appUser';
//$password = 'password';
//$config = require('config.php');
//$db = new Database($config['database'], $username, $password);
//$id = $_GET['id'];
// Variante 1
//$query = "SELECT * FROM posts WHERE id = ?";
//$posts = $db->query($query, [$id])->fetchAll(PDO::FETCH_ASSOC);
// Variante 2
//$query = "SELECT * FROM posts WHERE id = :id";
//$posts = $db->query($query, [':id' => $id])->fetchAll(PDO::FETCH_ASSOC);
// Beide Varianten machen inhaltlich das Gleiche.
// freie Wahl, welche der beiden Varianten bevorzugt wird.

//dd($posts);