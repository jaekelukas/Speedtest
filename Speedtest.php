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
    <?php
      include 'DatenbankVerbindung.php';
      ?>
    <form class="" method="">
      <section id=datenAnzeige>
        <table>
          <tr>
            <th>Download</th>
            <th>Upload</th>
            <th>Ping</th>
          </tr>
          <tr>
            <td id="downloadErgebnis">0 Mbit/s</td>
            <td id="uploadErgebnis">0 Mbit/s</td>
            <td id="pingErgebnis">0 ms</td>
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
    <article id="buttonAnzeige">
      <button id="startButton" >
        Start
      </button>
    </article>
    <section id="history">
      <table>
        <thead>
          <tr>
            <th>Datum, Zeit</th>
            <th>IP-Adresse</th>
            <th>Download</th>
            <th>Upload</th>
            <th>Ping</th>
          </tr>
        </thead>
          <tbody>
            <?php

            if(($history = $conn->query("select * from `Ranking` order by `Nr` desc"))==TRUE)
            {
              if (mysqli_num_rows($history) > 0) {
                $counter=0;
                while(($row = mysqli_fetch_assoc($history))&&($counter++ < 5)) {
                  echo "<tr>";
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
  </body>
  <script type="text/javascript" src="Speedtest.js"></script>

 </html>
