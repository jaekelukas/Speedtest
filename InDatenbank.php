<?php
//Speichert die Hochgeladenen Daten in der Datenbank
  include 'DatenbankVerbindung.php';

//Daten einlesen
  $input=fopen("php://input","r");
  $json=fgets($input);
  fclose($input);
  if($json)
  {
//relevante Daten in Variablen speichern
    $obj = json_decode($json);
    $ping= $obj->ping;
    $download= $obj->download;
    $upload= $obj->upload;
    $date =date("Y-m-d h:i:s");
    $ip =$_SERVER['REMOTE_ADDR'];
//Eintrag in Datenbank
    $sql = "INSERT INTO `Ranking` (`IP`, `Download`, `Upload`, `Ping`, `Time`)
    VALUES ('$ip', '$download', '$upload', '$ping', '$date')";

    if ($conn->query($sql) === TRUE) {
      $last_id = $conn->insert_id;
      //echo json_encode("New record created successfully. Last inserted ID is: " . $last_id);
    } else {
      echo json_encode("Error: " . $sql . "<br>" . $conn->error);
    }
  }
  else
  {
    echo "Fehler";
  }
  echo $json;
  $conn->close();
 ?>
