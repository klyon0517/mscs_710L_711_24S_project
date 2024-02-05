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
  // setTimeout / clearTimeout
  // use num as a counter for the varying intervals
  
  getMetrics();
  var temp = setInterval(getMetrics, 30000);
  setTimeout(function( ) { clearInterval( temp ); }, 120000);

});

// var num = 0;

/* for (num; num < 4; num++) {
  
  setTimeout(getMetrics, 15000);
  
} */

/*  getMetrics
*
*   Obtains the server metrics from phpSysInfo
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
  
  // show loading bar / circle thing
  // don't show the page until data has been retrieved
  
  let hostname = metrics["Vitals"]["@attributes"].Hostname;
  let distro = metrics["Vitals"]["@attributes"].Distro;
  let kernal = metrics["Vitals"]["@attributes"].Kernel;
  let uptime = metrics["Vitals"]["@attributes"].Uptime;
  
  // Convert uptime to days, hours, mins
  let mins = uptime / 60;
  let hours = mins / 60;
  let days = Math.floor(hours / 24);
  let hoursAdj = Math.floor(hours - (days * 24));
  let minsAdj = Math.floor(mins - (days * 60 * 24) - (hoursAdj * 60));
  
  let numDays = (days) ? days.toString() + " days " : "";
  let numHours = (hoursAdj) ? hoursAdj.toString() + " hrs " : "";
  let numMins = (minsAdj) ? minsAdj.toString() + " mins" : "";
  let uptimeTxt = numDays + numHours + numMins;
  
  // Network data
  let networkName = metrics["Network"]["NetDevice"]["@attributes"].Name;
  let networkInfo = metrics["Network"]["NetDevice"]["@attributes"].Info;
  let networkReceived = metrics["Network"]["NetDevice"]["@attributes"].RxBytes;
  let networkSent = metrics["Network"]["NetDevice"]["@attributes"].TxBytes;
  
  // Split info at ';'
  // The third item will be the IP add
  const networkInfoArray = networkInfo.split(";");
  let ipAddress = networkInfoArray[2];
  
  // Convert bytes to MB
  let receivedMB = (networkReceived / 1048576).toFixed(2) + " MB";
  let sentMB = (networkSent / 1048576).toFixed(2) + " MB";
  
  // CPU data
  let cpuModel = metrics["Hardware"]["CPU"]["CpuCore"]["@attributes"].Model;
  let cpuLoad = metrics["Hardware"]["CPU"]["CpuCore"]["@attributes"].Load;
  let unusedCpuLoad = 100 - cpuLoad;  
  
  // Memory capacity
  let totalMemory = metrics["Memory"]["@attributes"].Total;
  let usedMemory = metrics["Memory"]["@attributes"].Used;
  
  // Percentage conversion
  let usedPercentageMemory = Math.round((usedMemory * 100) / totalMemory);
  let freePercentageMemory = 100 - usedPercentageMemory;
  
  // Storage capacity
  let usedStorage = metrics["FileSystem"]["Mount"]["@attributes"].Percent;
  let freeStorage = 100 - usedStorage;
    
  // Place info in divs
  document.getElementById('hostname').innerHTML = hostname;
  document.getElementById('distro').innerHTML = distro;
  document.getElementById('kernal').innerHTML = kernal;
  document.getElementById('uptime').innerHTML = uptimeTxt;
  
  document.getElementById('networkName').innerHTML = networkName;
  document.getElementById('networkIpAddress').innerHTML = ipAddress;
  document.getElementById('networkReceived').innerHTML = receivedMB;
  document.getElementById('networkSent').innerHTML = sentMB;
  
  // Current CPU
  document.getElementById('currentCpuLoadDiv').innerHTML = '<canvas id="currentCpuLoad" class="border p-3"></canvas>';
  const ctx1 = document.getElementById('currentCpuLoad');
  chartFormat(ctx1, "Current CPU Load", cpuLoad, unusedCpuLoad);
  
  // Current Memory
  document.getElementById('currentMemoryUsageDiv').innerHTML = '<canvas id="currentMemoryUsage" class="border p-3"></canvas>';
  const ctx5 = document.getElementById('currentMemoryUsage');
  chartFormat(ctx5, "Current Memory Usage", usedPercentageMemory, freePercentageMemory);
  
  // Current Storage
  document.getElementById('currentStorageUsageDiv').innerHTML = '<canvas id="currentStorageUsage" class="border p-3"></canvas>';
  const ctx9 = document.getElementById('currentStorageUsage');
  chartFormat(ctx9, "Current Storage Usage", usedStorage, freeStorage);
  
  const data = [];
  data[0] = hostname;
  data[1] = distro;
  data[2] = kernal;
  data[3] = uptimeTxt;
  data[4] = networkName;
  data[5] = ipAddress;
  data[6] = receivedMB;
  data[7] = sentMB;
  data[8] = cpuLoad;
  data[9] = unusedCpuLoad;
  data[10] = usedPercentageMemory;
  data[11] = freePercentageMemory;
  data[12] = usedStorage;
  data[13] = freeStorage;
  
  writeMetrics(data);
  
  
  // Historical CPU 15 min
  /* const ctx2 = document.getElementById('minCpuLoad');
  
  new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: [
        '15 min avg. CPU Load'
      ],
      datasets: [{
        label: 'Load%',
        data: [35, 65],
        backgroundColor: [
          'rgba(255, 193, 7, 0.85)',
          'rgba(185, 185, 185, 0.85)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  });
  
  // Historical CPU 1 hr
  const ctx3 = document.getElementById('hourCpuLoad');
  
  new Chart(ctx3, {
    type: 'pie',
    data: {
      labels: [
        '1 hr avg. CPU Load'
      ],
      datasets: [{
        label: 'Load%',
        data: [15, 85],
        backgroundColor: [
          'rgba(25, 135, 84, 0.7)',
          'rgba(185, 185, 185, 0.7)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  });
  
  // Historical CPU 1 day
  const ctx4 = document.getElementById('dayCpuLoad');
  
  new Chart(ctx4, {
    type: 'pie',
    data: {
      labels: [
        '1 day avg. CPU Load'
      ],
      datasets: [{
        label: 'Load%',
        data: [5, 95],
        backgroundColor: [
          'rgba(25, 135, 84, 0.55)',
          'rgba(185, 185, 185, 0.55)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  });
  
  
  // Historical Memory 15 min
  const ctx6 = document.getElementById('minMemoryUsage');
  
  new Chart(ctx6, {
    type: 'pie',
    data: {
      labels: [
        '15 min avg. Memory Usage'
      ],
      datasets: [{
        label: 'Usage%',
        data: [65, 45],
        backgroundColor: [
          'rgba(253, 126, 20, 0.85)',
          'rgba(185, 185, 185, 0.85)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  });
  
  // Historical Memory 1 hr
  const ctx7 = document.getElementById('hourMemoryUsage');
  
  new Chart(ctx7, {
    type: 'pie',
    data: {
      labels: [
        '1 hr avg. Memory Usage'
      ],
      datasets: [{
        label: 'Usage%',
        data: [45, 55],
        backgroundColor: [
          'rgba(255, 193, 7, 0.7)',
          'rgba(185, 185, 185, 0.7)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  });
  
  // Historical Memory 1 day
  const ctx8 = document.getElementById('dayMemoryUsage');
  
  new Chart(ctx8, {
    type: 'pie',
    data: {
      labels: [
        '1 day avg. Memory Usage'
      ],
      datasets: [{
        label: 'Usage%',
        data: [15, 85],
        backgroundColor: [
          'rgba(25, 135, 84, 0.55)',
          'rgba(185, 185, 185, 0.55)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  });
  
  // Historical Storage 15 min
  const ctx10 = document.getElementById('minStorageUsage');
  
  new Chart(ctx10, {
    type: 'pie',
    data: {
      labels: [
        '15 min avg. Storage Usage'
      ],
      datasets: [{
        label: 'Usage%',
        data: [15, 85],
        backgroundColor: [
          'rgba(25, 135, 84, 0.85)',
          'rgba(185, 185, 185, 0.85)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  });
  
  // Historical Storage 1 hr
  const ctx11 = document.getElementById('hourStorageUsage');
  
  new Chart(ctx11, {
    type: 'pie',
    data: {
      labels: [
        '1 hr avg. Storage Usage'
      ],
      datasets: [{
        label: 'Usage%',
        data: [40, 60],
        backgroundColor: [
          'rgba(255, 193, 7, 0.7)',
          'rgba(185, 185, 185, 0.7)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  });
  
  // Historical Storage 1 day
  const ctx12 = document.getElementById('dayStorageUsage');
  
  new Chart(ctx12, {
    type: 'pie',
    data: {
      labels: [
        '1 day avg. Storage Usage'
      ],
      datasets: [{
        label: 'Usage%',
        data: [15, 85],
        backgroundColor: [
          'rgba(25, 135, 84, 0.55)',
          'rgba(185, 185, 185, 0.55)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  }); */
    
};



/*  chartFormat
*
*   Formats style and data for the various charts
*
*   parameters:
*       div -- name of the element to place the chart
*       label -- label for the chart
*       dat1 -- first piece of data (usually usage)
*       dat2 -- second piece of data (usually free)
*       color -- rgba color based on usage
*  
*   return value: none
*
*/
function chartFormat(div, label, dat1, dat2) {
  
  let color = "";
  
  if (dat1 < 26) {
    
    color = "rgba(25, 135, 84, 1.0)";
    
  } else if (dat1 > 25 && dat1 < 51) {
    
    color = "rgba(255, 193, 7, 1.0)";
    
  } else if (dat1 > 50 && dat1 < 76) {
    
    color = "rgba(253, 126, 20, 1.0)";
    
  } else if (dat1 > 75) {
    
    color = "rgba(220, 53, 69, 1.0)";
  
  }
  
  new Chart(div, {
    type: 'pie',
    data: {
      labels: [label],
      datasets: [{
        label: '%',
        data: [dat1, dat2],
        backgroundColor: [
          color,
          'rgba(185, 185, 185, 0.55)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false
    }
  });
  
}



/*  writeMetrics
*
*   Inserts the metrics into the DB
*
*   parameters:
*       data -- json formatted server metrics
*  
*   return value: success response
*
*/
async function writeMetrics(data) {
  
  let dat0 = data[0];
  let dat1 = data[1];
  let dat2 = data[2];
  let dat3 = data[3];
  let dat4 = data[4];
  let dat5 = data[5];
  let dat6 = data[6];
  let dat7 = data[7];
  let dat8 = data[8];
  let dat9 = data[9];
  let dat10 = data[10];
  let dat11 = data[11];
  let dat12 = data[12];
  let dat13 = data[13];
  
  const options = {
    method: 'POST',
    headers: {
      "Content-Type": "application/json"
    },
    body: encodeURIComponent(JSON.stringify({
      hostname: dat0,
      distro: dat1,
      kernal: dat2,
      uptime: dat3,
      network_name: dat4,
      ip_address: dat5,
      received_mb: dat6,
      sent_mb: dat7,
      cpu_load: dat8,
      cpu_free: dat9,
      memory_load: dat10,
      memory_free: dat11,
      storage_used: dat12,
      storage_free: dat13}))
  };

  const response = await fetch("../api/post_phpsysinfo_json.php", options);
  const jsonResponse = await response.json();
  
  console.log(jsonResponse.success);
    
}