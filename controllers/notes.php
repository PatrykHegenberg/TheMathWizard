<?php
    $username = 'appUser';
    $password = 'password';
    $config = require('config.php');
    $db = new Database($config['database'], $username, $password);

    $heading = "My Notes";

    $notes = $db->query('select * from notes where user_id = 1')->get();
    //dd($notes);
    require "views/notes.view.php";