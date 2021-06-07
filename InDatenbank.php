<?php
  include 'DatenbankVerbindung.php';

  $input=fopen("php://input","r");
  $json=fgets($input);
  fclose($input);
  if($json)
  {
    $obj = json_decode($json);
    $ping= $obj->ping;
    $download= $obj->download;
    $upload= $obj->upload;
    $date =date("Y-m-d h:i:s");
    $ip =$_SERVER['REMOTE_ADDR'];

    header('Content-Type: application/json');
    echo json_encode($obj);


    $sql = "INSERT INTO `Ranking` (`IP`, `Download`, `Upload`, `Ping`, `Time`)
    VALUES ('$ip', '$download', '$upload', '$ping', '$date')";

    if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  else
  {
    echo "Fehler";
  }

  $conn->close();
 ?>
