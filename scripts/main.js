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
  
  getMetrics();

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
  /* const response = await fetch("http://localhost/phpsysinfo/xml.php?plugin=complete&json");
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
    "Remaining: " + unusedCpuLoad; */
  
  /* const ctx = document.getElementById('myChart');
   
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
  }); */
  
  // Current CPU
  const ctx1 = document.getElementById('currentCpuLoad');
  
  new Chart(ctx1, {
    type: 'pie',
    data: {
      labels: [
        'Current CPU Load'
      ],
      datasets: [{
        label: 'Load%',
        data: [25, 75],
        backgroundColor: [
          'rgba(25, 135, 84, 1.0)',
          'rgba(185, 185, 185, 1.0)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true
    }
  });
  
  // Historical CPU 15 min
  const ctx2 = document.getElementById('minCpuLoad');
  
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
  
  // Current Memory
  const ctx5 = document.getElementById('currentMemoryUsage');
  
  new Chart(ctx5, {
    type: 'pie',
    data: {
      labels: [
        'Current Memory Usage'
      ],
      datasets: [{
        label: 'Usage%',
        data: [80, 20],
        backgroundColor: [
          'rgba(220, 53, 69, 1.0)',
          'rgba(185, 185, 185, 1.0)'
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
  
  // Current Storage
  const ctx9 = document.getElementById('currentStorageUsage');
  
  new Chart(ctx9, {
    type: 'pie',
    data: {
      labels: [
        'Current Storage Usage'
      ],
      datasets: [{
        label: 'Usage%',
        data: [30, 70],
        backgroundColor: [
          'rgba(255, 193, 7, 1.0)',
          'rgba(185, 185, 185, 1.0)'
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
  });
  
  
  
  
  
  
  
  /* const data = [];
  data[0] = hostname;
  data[1] = cpuModel;
  data[2] = cpuLoad;
  
  writeMetrics(data); */
  
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