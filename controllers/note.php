<?php
$username = 'appUser';
$password = 'password';
$config = require('config.php');
$db = new Database($config['database'], $username, $password);

$heading = "Note";
$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize(($note['user_id'] === $currentUserId));


//dd($notes);
require "views/note.view.php";
