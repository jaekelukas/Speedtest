<?php
//eröffnet eine Datenbank Verbindung
  $servername = "Servername";
  $username = "Username";
  $password = "Passwort";
  $dbname = "Speedtest";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }

 ?>
