var downloadContent=0;
var dlcsize=0;
var repeat=5;




async function pinging() {
  let startTime = new Date().getTime();
  try {
    response = await fetch("https://192.168.55.201:8081/Speedtest/Ping.html",{ method: "HEAD" });
    return startTime;
  } catch (error) {
    return -1;
  }
}
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
async function save(pingErgebnis, downloadErgebnis, uploadErgebnis)
{
  const obj={"ping":pingErgebnis, "download":downloadErgebnis,"upload":uploadErgebnis}
  console.log(obj)
  const request = new XMLHttpRequest()

  request.open('POST', 'https://192.168.55.201:8081/Speedtest/InDatenbank.php')
  request.setRequestHeader('Content-Type', 'application/json')
  request.onload = function () {
    if (request.status === 200) {
        console.log('Upload erfolgreich')
        console.log(request.responseText);

        location.reload(true)

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

document.getElementById("startButton").onclick = async () => {
  pingErgebnis.textContent="0 MBit/s"
  downloadErgebnis.textContent="0 MBit/s"
  uploadErgebnis.textContent="0 ms"
  fortschritt.value=""

  let pvalue=0;
  for (var i = 1; i <= repeat; i++) {
    await pinging().then(function (result) {
      let endTime = new Date().getTime();
      if (result == -1) {
        pingErgebnis.textContent = "Someone fucked up";
      } else {
        pvalue+=(endTime- result.toFixed(0));
      }
    });
  }
  pingErgebnis.textContent =Math.round(pvalue/repeat)+" ms"

  let dvalue=0;
  for (var i = 1; i <= repeat; i++) {
    await loaddown().then(function (result) {
      let endTime =new Date().getTime();
      if (result == -1) {
        downloadErgebnis.textContent = "Someone fucked up";
      } else {
        downloadErgebnis.textContent = Math.round(((dlcsize/(endTime-result.toFixed(0)))/Math.pow(10,3))*100)/100;
        dvalue+=(dlcsize/(endTime-result.toFixed(0)))/Math.pow(10,3);
      }
    });
    fortschritt.value += 10
  }
  downloadErgebnis.textContent =Math.round((dvalue/repeat)*100)/100+" MBit/s"

  let uvalue=0;
  for (var i = 1; i <= repeat; i++) {
    await loadup().then(function (result) {
      let endTime=new Date().getTime();
      if (result == -1) {
        uploadErgebnis.textContent = "Someone fucked up";
      } else {
        uploadErgebnis.textContent = Math.round(((dlcsize/(endTime-result.toFixed(0)))/Math.pow(10,3))*100)/100;
        uvalue+=(dlcsize/(endTime-result.toFixed(0)))/Math.pow(10,3);
      }
    });
    fortschritt.value += 10
  }
  uploadErgebnis.textContent =Math.round((uvalue/repeat)*100)/100+" MBit/s"
  //let data

  await save(pingErgebnis.textContent, downloadErgebnis.textContent, uploadErgebnis.textContent);
};
