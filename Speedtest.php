<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Speedtest.css">
    <title>Speedtest</title>
  </head>
  <body>
    <header>
      <h3>Speedtest</h3>
    </header>
    <section id=datenAnzeige>
      <button id="startButton" >
        Start
      </button>
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
    <section id=fortschrittsAnzeige>
      <label for="fortschritt">Fortschritt:</label>
      <meter id="fortschritt"
             min="0" max="100" value="0">
      </meter>
    </section>
    <footer>
    </footer>
  </body>
  <script type="text/javascript" src="Speedtest.js"></script>
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "my1stQNAP";
    $dbname = "Speedtest";
    //echo "<p>Connection</p>";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `Ranking` (`Nr`, `IP`, `Download`, `Upload`, `Ping`, `Time`)
    VALUES ('1', '192.168.1.1', '50 MBits', '50 MBits', '10', '2021-05-27 07:39:31')";

    if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

   ?>
 </html>
