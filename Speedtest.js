var downloadContent=0;
var dlcsize=0;
function calculateDL(){

}
function calculateUL(){

}

async function pinging() {
  let startTime = new Date().getTime();
  try {
    var response = await fetch("https://192.168.55.201:8081/Speedtest/Ping.txt",{ method: "HEAD" });
    //evtl Ping datei
    return startTime;
  } catch (error) {
    return -1;
  }
}
async function loaddown(){
  let startTime = new Date().getTime();
  try {
    var response = await fetch("https://192.168.55.201:8081/Speedtest/Data25");
    dlcsize =response.headers.get("content-length")*8
    downloadContent=await response.text()
    return startTime
  } catch (error) {
    return -1;
  }
}
async function loadup(){
  let startTime = new Date().getTime();
  let endTime = null;
  try {
        var response = await fetch("https://192.168.55.201:8081/Speedtest/Data25",
        {
          method: "POST",
          body: downloadContent
        });//while schleife?
    endTime=new Date().getTime();
    console.log(endTime-startTime)
    return (dlcsize/(endTime-startTime))/Math.pow(10,3);
  } catch (error) {
    return -1;
  }
}

let pingErgebnis = document.getElementById("pingErgebnis");
let downloadErgebnis = document.getElementById("downloadErgebnis");
let uploadErgebnis = document.getElementById("uploadErgebnis");

document.getElementById("startButton").onclick = async () => {
  await pinging().then(function (result) {
      let endTime = new Date().getTime();
    if (result == -1) {
      pingErgebnis.textContent = "Someone fucked up";
    } else {
      pingErgebnis.textContent =endTime- result.toFixed(0);
      console.log(window.webkitPerformance);
      console.log(window.msPerformance);
      console.log(window.mozPerformance);
      console.log(window.performance)
    }
  });
  await loaddown().then(function (result) {
      endTime =new Date().getTime();
    if (result == -1) {
      downloadErgebnis.textContent = "Someone fucked up";
    } else {
      downloadErgebnis.textContent = (dlcsize/(endTime-result.toFixed(2)))/Math.pow(10,3);
      console.log(window.performance)
    }
  });
  await loadup().then(function (result) {
    if (result == -1) {
      uploadErgebnis.textContent = "Someone fucked up";
    } else {
      uploadErgebnis.textContent = result.toFixed(2);
      console.log(window.performance)
    }
  });
};
