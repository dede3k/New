<?php
  function connectDB() {
  global $mysqli;
  $mysqli = new mysqli("localhost", "root", "", "RegisterUsers");
  if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
  }
  $mysqli->query("SET NAMES 'utf8'");
  }
  ?>
