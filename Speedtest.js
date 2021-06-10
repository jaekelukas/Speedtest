//String mit Heruntergelanden Daten
var downloadContent=0;
//Größe der Heruntergelanden Daten
var dlcsize=0;
//Anzahl der Down- und Uploads
var repeat=5;



//Funktion nimmt die Startzeit, führt dann einen Download einer kleinen Datei aus
//und liefert danach die Startzeit zurück
async function pinging() {
  let startTime = new Date().getTime();
  try {
    response = await fetch("https://192.168.55.201:8081/Speedtest/Ping.html",{ method: "HEAD" });
    return startTime;
  } catch (error) {
    return -1;
  }
}
//Funktion nimmt die Startzeit, führ dann den Download einer Datei aus, speichert deren
//Inhalt und Größe und gibt anschließend die Startzeit zurück
async function loaddown(){
  let startTime = new Date().getTime();
  try {
    response = await fetch("https://192.168.55.201:8081/Speedtest/Data.txt");
    dlcsize =response.headers.get("content-length")*8
    downloadContent=await response.text()

    return startTime
  } catch (error) {
    return -1;
  }
}
//Funktion nimmt die Startzeit, führt dann den Upload der zuvor Heruntergelanden Datei aus
//und liefert anschließend die Startzeit zurück
async function loadup(){
  let startTime = new Date().getTime();
  try {
        response = await fetch("https://192.168.55.201:8081/Speedtest/Data.txt",
        {
          method: 'POST',
          body: downloadContent
        });
    return startTime;
  } catch (error) {
    return -1;
  }
}

//Funktion erstellt ein JSON-Objekt aus den Speedtestergebnissen, lädt diese anschließend hoch
//und lädt die Seite neu
async function save(pingErgebnis, downloadErgebnis, uploadErgebnis, fortschritt)
{
  const obj={"ping":pingErgebnis, "download":downloadErgebnis,"upload":uploadErgebnis}
  const request = new XMLHttpRequest()

  request.open('POST', 'https://192.168.55.201:8081/Speedtest/InDatenbank.php')
  request.setRequestHeader('Content-Type', 'application/json')
  request.onload = function () {
    if (request.status === 200) {
        console.log(request.responseText)

        window.open('https://192.168.55.201:8081/Speedtest/Speedtest.php?download='+downloadErgebnis+'&upload='+uploadErgebnis+
        '&ping='+pingErgebnis+'&fortschritt='+fortschritt,"_self")
        //location.reload(true)

    } else {
        console.log('Fehler beim Upload'+request.responseText)
    }
  };
  request.send(JSON.stringify(obj));
}



let pingErgebnis = document.getElementById("pingErgebnis");
let downloadErgebnis = document.getElementById("downloadErgebnis");
let uploadErgebnis = document.getElementById("uploadErgebnis");
let fortschritt = document.getElementById("fortschritt")

//Nachdem der Button geklickt wurde, werden Ping, Download und Upload berechnet,
//anschließend werden die Dateien auf den Server geladen und in der Datenbank gespeichert
document.getElementById("startButton").onclick = async () => {
  pingErgebnis.textContent="0 MBit/s"
  downloadErgebnis.textContent="0 MBit/s"
  uploadErgebnis.textContent="0 ms"
  fortschritt.value=""

  //pinging Funktion wird aufgerufen, dann die Endzeit genommen. Dieser Vorgang wird wiederholt.
  let pvalue=0;
  for (var i = 1; i <= repeat; i++) {
    await pinging().then(function (result) {
      let endTime = new Date().getTime();
      if (result == -1) {
        pingErgebnis.textContent = "Keine Verbindung";
      } else {
        pvalue+=(endTime- result.toFixed(0));
      }
    });
  }
  //Ping wird ausgerechnet und pingErgebnis hinzugefügt
  pingErgebnis.textContent =Math.round(pvalue/repeat)+" ms"

  //loaddown Funktion wird aufgerufen, dann die Endzeit genommen, dann mit den aktuellen Daten ein
  //Zwischenergebnis ausgerechnet und angezeit. Dieser Vorgang wird wiederholt
  let dvalue=0;
  for (var i = 1; i <= repeat; i++) {
    await loaddown().then(function (result) {
      let endTime =new Date().getTime();
      if (result == -1) {
        downloadErgebnis.textContent = "Keine Verbindung";
      } else {
        downloadErgebnis.textContent = Math.round(((dlcsize/(endTime-result.toFixed(0)))/Math.pow(10,3))*100)/100+" MBit/s";
        dvalue+=(dlcsize/(endTime-result.toFixed(0)))/Math.pow(10,3);
      }
    });
    fortschritt.value += 10
  }
  //Download wird ausgerechnet und downloadErgebnis hinzugefügt
  downloadErgebnis.textContent =Math.round((dvalue/repeat)*100)/100+" MBit/s"

  //loadup Funktion wird aufgerufen, dann die Endzeit genommen, dann mit den aktuellen Daten ein
  //Zwischenergebnis ausgerechnet und angezeit. Dieser Vorgang wird wiederholt
  let uvalue=0;
  for (var i = 1; i <= repeat; i++) {
    await loadup().then(function (result) {
      let endTime=new Date().getTime();
      if (result == -1) {
        uploadErgebnis.textContent = "Keine Verbindung";
      } else {
        uploadErgebnis.textContent = Math.round(((dlcsize/(endTime-result.toFixed(0)))/Math.pow(10,3))*100)/100+" MBit/s";
        uvalue+=(dlcsize/(endTime-result.toFixed(0)))/Math.pow(10,3);
      }
    });
    fortschritt.value += 10
  }
  //Upload wird ausgerechnet und uploadErgebnis hinzugefügt
  uploadErgebnis.textContent =Math.round((uvalue/repeat)*100)/100+" MBit/s"

  //Daten speichern
  await save(pingErgebnis.textContent, downloadErgebnis.textContent, uploadErgebnis.textContent, fortschritt.value);
};
