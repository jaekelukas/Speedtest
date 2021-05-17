var downloadContent=0;
var dlcsize=0;
function calculateDL(){

}
function calculateUL(){

}

async function pinging() {
  let startTime = new Date().getTime();
  let endTime = null;
  try {
    var response = await fetch("https://192.168.55.201:8081/Testat_3_Speedtest/Test.php",{ method: "HEAD" });
    //evtl Ping datei
    endTime = new Date().getTime();
    return Math.abs(startTime - endTime);
  } catch (error) {
    return -1;
  }
}
async function loaddown(){
  let startTime = new Date().getTime();
  let endTime = null;
  try {
    var response = await fetch("https://192.168.55.201:8081/Testat_3_Speedtest/Data.txt");
    console.log(response)
    dlcsize =response.headers.get("content-length")*8
    endTime = new Date().getTime();
    downloadContent=await response.text()
    return (dlcsize/(endTime-startTime))/Math.pow(10,6)*1000;
  } catch (error) {
    return -1;
  }
}
async function loadup(){
  let startTime = new Date().getTime();
  let endTime = null;
  console.log(startTime/1000)
  try {
        var response = await fetch("https://192.168.55.201:8081/Testat_3_Speedtest/Uploadtest.php",
      {
        method: "POST",
        body: downloadContent
    });//while schleife?
    endTime=Number(await response.text());
    console.log(endTime)
    return (dlcsize/(endTime-(startTime/1000)))/Math.pow(10,6);
  } catch (error) {
    return -1;
  }
}

let pingErgebnis = document.getElementById("pingErgebnis");
let downloadErgebnis = document.getElementById("downloadErgebnis");
let uploadErgebnis = document.getElementById("uploadErgebnis");

document.getElementById("startButton").onclick = async () => {
  await pinging().then(function (result) {
    if (result == -1) {
      pingErgebnis.textContent = "Someone fucked up";
    } else {
      pingErgebnis.textContent = result.toFixed(2);
    }
  });
  await loaddown().then(function (result) {
    if (result == -1) {
      downloadErgebnis.textContent = "Someone fucked up";
    } else {
      downloadErgebnis.textContent = result.toFixed(2);
    }
  });
  await loadup().then(function (result) {
    if (result == -1) {
      uploadErgebnis.textContent = "Someone fucked up";
    } else {
      uploadErgebnis.textContent = result.toFixed(2);
    }
  });
};
