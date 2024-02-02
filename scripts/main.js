/*  Metrics Project

    * Software: Project
    * Marist Class: MSCS_710L_711_24S
    * Filename: main.js
    * Author: Kerry Lyon
    * Created: January 28, 2024

    * This file contains the main JavaScript functions.
  
*/

window.addEventListener("load", function() {
  
  // Start a time date when page loads
  // run script every 15 secons for first hour
  // then less and less as time goes on
  // setInterval / clearInterval

});



/*  getMetrics
*
*   Creates???
*
*   parameters:
*       display -- plugin json
*  
*   return value: json response
*
*/

async function getMetrics() {
  
  // const response = await fetch("http://3.135.19.80/phpsysinfo/xml.php?plugin=complete&json");
  const response = await fetch("http://localhost/phpsysinfo/xml.php?plugin=complete&json");
  const metrics = await response.json();
  
  let hostname = metrics["Vitals"]["@attributes"].Hostname;
  let cpuModel = metrics["Hardware"]["CPU"]["CpuCore"]["@attributes"].Model;
  let cpuLoad = metrics["Hardware"]["CPU"]["CpuCore"]["@attributes"].Load;
  let unusedCpuLoad = 100 - cpuLoad;
  
  document.getElementById("metrics").innerHTML =
    "Host: " + hostname +
    "<br><br>" +
    "Model: " + cpuModel +
    "<br><br>" +
    "Load: " + cpuLoad +
    "<br><br>" +
    "Remaining: " + unusedCpuLoad;
  
  const ctx = document.getElementById('myChart');
   
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: [
        'Load',
        'Remaining'
      ],
      datasets: [{
        label: 'CPU Load %',
        data: [cpuLoad, unusedCpuLoad],
        backgroundColor: [
          'rgb(54, 162, 235)',
          'rgb(185, 185, 185)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  });
  
  const data = [];
  data[0] = hostname;
  data[1] = cpuModel;
  data[2] = cpuLoad;
  
  writeMetrics(data);
  
};

async function writeMetrics(data) {
  
  let dat0 = data[0];
  let dat1 = data[1];
  let dat2 = data[2];
  
  const options = {
    method: 'POST',
    headers: {
      "Content-Type": "application/json"
    },
    body: encodeURIComponent(JSON.stringify({
      hostname: dat0,
      cpuModel: dat1,
      cpuLoad: dat2}))
  };

  const response = await fetch("../api/post_phpsysinfo_json.php", options);
  const jsonResponse = await response.json();
  
  console.log(jsonResponse.success);
    
}