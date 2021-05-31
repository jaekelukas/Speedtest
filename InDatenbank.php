<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      /*$servername = "localhost";
      $username = "root";
      $password = "my1stQNAP";
      $dbname = "Speedtest";

      $conn = new mysqli($servername, $username, $password, $dbname);

      $sql = "INSERT INTO `Ranking` (`Nr`, `IP`, `Download`, `Upload`, `Ping`, `Time`)
      VALUES ('5', '192.168.1.1', '50 MBits', '50 MBits', '10', '2021-05-27 07:39:31')";

      if ($conn->query($sql) === TRUE) {
      $last_id = $conn->insert_id;
      echo "New record created successfully. Last inserted ID is: " . $last_id;
      } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $input=fopen("php://input","r");
      $json=fgets($input);
      fclose($input);
      if($json)
      {
        $obj = json_decode($json);
        echo $obj;
      }
      else
      {
        echo "Fehler";
      }

      //timestamp + while(true)
      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $sql = "INSERT INTO `Ranking` (`Nr`, `IP`, `Download`, `Upload`, `Ping`, `Time`)
      VALUES ('5', '192.168.1.1', '50 MBits', '50 MBits', '10', '2021-05-27 07:39:31')";



      //  $conn->close();*/
      echo $_SERVER['REMOTE_ADDR']."\n";
      echo date("Y-m-d h:i:s");

      $json = file_get_contents('php://input');
      $data = json_decode($json);
      echo $data;
      /*$input=fopen("php://input","r");

      $json =fgets($input);
      $dl=fgets($input);

      fclose($input);
      $ping=json_decode($json)->ping;
      $dl=json_decode($dl)->download;
      echo "Ping: $ping";
      echo "Download: $dl";
      echo "1\n";
      foreach ($_REQUEST as $key => $value) {
        echo json_decode($value)."\n";
      }
      echo "2\n";
      foreach ($_POST as $key => $value) {
        echo json_decode($value)."\n";
      }
      echo "3\n";
      echo json_decode($_POST);
      echo json_decode($_REQUEST);
      $this -> statusText="ok";*/
     ?>
  </body>
</html>
