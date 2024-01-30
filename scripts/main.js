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

function getMetrics() {
  
  /* let display = {
    "plugin" : "complete",
    "json" : ""
  }; */
  
  /* let options = {
    method: 'POST',
    headers: {
      'Content-Type':
        'application/json'
    },
    body: JSON.stringify(display)
  }; */
  
  fetch("http://localhost/phpsysinfo/xml.php?plugin=complete&json")
  // fetch("../phpsysinfo/xml.php", options)
  .then(x => x.text())
  .then(y => document.getElementById("metrics").innerHTML = y);
  // Once response is received run another fetch
  // POST with the parsed json to be saved to the DB
  
};