<?php
$heading = "Learn";

session_start();
if(!isset($_SESSION["username"])){
  header("Location: /");
  exit;
}
require "views/learn.view.php";
