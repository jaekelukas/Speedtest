<?php
//eröffnet eine Datenbank Verbindung
  $servername = "localhost";
  $username = "root";
  $password = "my1stQNAP";
  $dbname = "Speedtest";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }

 ?>
