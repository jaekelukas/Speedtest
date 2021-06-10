<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Speedtest.css">
    <title>Speedtest</title>
  </head>
  <body>
    <header>
      <h1>Speedtest</h1>
    </header>
    <main>
      <section id=datenAnzeige>
        <table>
          <tr>
            <th>Download</th>
            <th>Upload</th>
            <th>Ping</th>
          </tr>
          <tr>
            <td id="downloadErgebnis"><?= $_GET["download"] == null ? "0 MBit/s" : $_GET["download"]?></td>
            <td id="uploadErgebnis"><?= $_GET["upload"] == null ? "0 MBit/s" : $_GET["upload"]?></td>
            <td id="pingErgebnis"><?= $_GET["ping"] == null ? "0 ms" : $_GET["ping"]?></td>
          </tr>
        </table>

        <section id="fortschrittsAnzeige">
          <label for="fortschritt">Fortschritt:</label>
          <meter id="fortschritt"
                 min="0" max="100" value=<?= $_GET["fortschritt"] == null ? "0" : $_GET["fortschritt"]?>>
          </meter>
        </section>
      </section>
      <article id="buttonAnzeige">
        <button id="startButton" >
          Start
        </button>
      </article>
      <p>Letzte Ergebnisse</p>
      <section>
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
              include 'DatenbankVerbindung.php';
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
        <p>Bester Download</p>
      <section>
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
              include 'DatenbankVerbindung.php';
              if(($history = $conn->query("select * from `Ranking` order by `Download` desc"))==TRUE)
              {
                if (mysqli_num_rows($history) > 0) {
                  $row = mysqli_fetch_assoc($history);
                    echo "<tr>";
                    echo "<td>".$row["Time"]."</td>";
                    echo "<td>".$row["IP"]."</td>";
                    echo "<td>".$row["Download"]."</td>";
                    echo "<td>".$row["Upload"]."</td>";
                    echo "<td>".$row["Ping"]."</td>";
                    echo "</tr>";
                  }
                }

              $conn->close();
             ?>
           </tbody>
        </table>
      </section>
    </main>
  </body>
  <script type="text/javascript" src="Speedtest.js"></script>

 </html>
