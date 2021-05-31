<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Speedtest.css">
    <title>Speedtest</title>
  </head>
  <body>
    <?php

      /*
      $input=fopen("php://input",'r');
      $json=fgets($input);
      fclose($input);

        echo $obj;
        /*echo $obj->ping;
        echo $obj->download;
        echo $obj->upload;
        if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id;
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

    }*/
      $servername = "localhost";
      $username = "root";
      $password = "my1stQNAP";
      $dbname = "Speedtest";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
     ?>
    <header>
      <h3>Speedtest</h3>
    </header>
    <form class="" action="index.html" method="post">
      <section id=datenAnzeige>
        <table>
          <tr>
            <th>Download</th>
            <th>Upload</th>
            <th>Ping</th>
          </tr>
          <tr>
            <td id="downloadErgebnis"></td>
            <td id="uploadErgebnis"></td>
            <td id="pingErgebnis"></td>
          </tr>
        </table>
      </section>
      <section id="fortschrittsAnzeige">
        <label for="fortschritt">Fortschritt:</label>
        <meter id="fortschritt"
               min="0" max="100" value="0">
        </meter>
      </section>
    </form>
    <section id="history">
      <table>
        <thead>
          <tr>
            <th>Nummer</th>
            <th>Datum, Zeit</th>
            <th>IP-Adresse</th>
            <th>Download</th>
            <th>Upload</th>
            <th>Ping</th>
          </tr>
        </thead>
          <tbody>
          <?php
            //where Nr=(max(Nr)-$i)
            if(($history = $conn->query("select * from `Ranking`"))==TRUE)
            {
              echo "Test1";

              if (mysqli_num_rows($history) > 0) {

                echo "Test2";

                $counter=0;
                while(($row = mysqli_fetch_assoc($history))&&($counter++ < 5)) {
                  echo "<tr>";
                  echo "<td>".$row["Nr"]."</td>";
                  echo "<td>".$row["Time"]."</td>";
                  echo "<td>".$row["IP"]."</td>";
                  echo "<td>".$row["Download"]."</td>";
                  echo "<td>".$row["Upload"]."</td>";
                  echo "<td>".$row["Ping"]."</td>";
                  echo "</tr>";

                  }
                }
              }

            $conn->close();
           ?>

         </tbody>
      </table>
    </section>

    <footer>
      <article id="buttonAnzeige">
        <button id="startButton" >
          Start
        </button>
      </article>
    </footer>
  </body>
  <script type="text/javascript" src="Speedtest.js"></script>

 </html>
