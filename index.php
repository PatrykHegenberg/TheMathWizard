<?php
require 'functions.php';

//require 'router.php';
// connect to MySQL database.
$dsn = "mysql:host=localhost;port=3306;dbname=myapp;charset=utf8mb4";
$username = 'appUser';
$password = 'password';
$pdo = new PDO($dsn, $username, $password);

$statement = $pdo->prepare("SELECT * FROM posts");
$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo "<li>" . $post['title'] . "</li>";
}