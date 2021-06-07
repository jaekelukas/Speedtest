
    <?php
    try {
      $servername = "localhost";
      $username = "root";
      $password = "my1stQNAP";
      $dbname = "Speedtest";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }

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

      mysqli_close($conn);
    } catch (\Exception $e) {
        echo "Baum";
    }
/*
      echo "Input:".var_dump(file_get_contents('php://input'))."</br>";
      echo "Post:".var_dump($_POST)."</br>";
      echo "Get:".var_dump($_GET)."</br>";
      echo "Request:".var_dump($_REQUEST)."</br>";
      $input=fopen("php://input","r");

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
