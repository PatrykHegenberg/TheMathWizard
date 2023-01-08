<?php
$heading = "profile";
session_start();
if(!isset($_SESSION["username"])){
  header("Location: /");
  exit;
}
require "views/profile.view.php";
