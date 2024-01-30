<?php

  /*  Metrics Project

      * Software: Project
      * Marist Class: MSCS_710L_711_24S
      * Filename: get_phpsysinfo_json.php
      * Author: Kerry Lyon
      * Created: January 29, 2024

      * This file queries phpsysinfo for the server metrics and
      * saves them to the database.

  */
  
  date_default_timezone_set("America/New_York");
  
  try {
    
    // From URL to get webpage contents.
    $url = "http://localhost/phpsysinfo/xml.php?plugin=complete&json";
     
    // Initialize a CURL session.
    $ch = curl_init(); 
     
    // Return Page contents.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     
    //grab URL and pass it to the variable.
    curl_setopt($ch, CURLOPT_URL, $url);
     
    $result = curl_exec($ch);
     
    echo $result; 
    
    
  } catch (Exception $e) {
    
    $errDate = date("Y-m-d H:i:s");
    $error_type = "GET";
    $method = "phpsysinfo";
    $file = "get_phpsysinfo_json";
    $message = "Unable to retrieve system metrics using phpsysinfo.";
    $error = $e->getMessage();
    $file_pointer = "../logs/phpsysinfo_error.log";
    
    require '../error/error_write.php';  
    
  }

?>