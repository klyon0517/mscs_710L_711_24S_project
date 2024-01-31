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
  
  // fetch("http://localhost/phpsysinfo/xml.php?plugin=complete&json")
  // fetch("http://3.135.19.80/phpsysinfo/xml.php?plugin=complete&json")
  // .then(x => x.text())
  // .then(y => y);
  // Once response is received run another fetch
  // POST with the parsed json to be saved to the DB
  
  const response = await fetch("http://localhost/phpsysinfo/xml.php?plugin=complete&json");
  const metrics = await response.json();
  
  // console.log(metrics);
  
  // const obj = JSON.parse(metrics);
  
  let hostname = metrics["Vitals"]["@attributes"].Hostname;
  document.getElementById("metrics").innerHTML = hostname;
  
  console.log(hostname);
  
  writeMetrics(hostname);
  
};

async function writeMetrics(data) {
  
  const options = {
    method: 'POST',
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({hostname: data})
  };

  const response = await fetch("../api/post_phpsysinfo_json.php", options);
  const jsonResponse = await response.json();
  
  // document.getElementById("metrics").innerHTML = jsonResponse.success;
  
  console.log(jsonResponse.success);
    
}