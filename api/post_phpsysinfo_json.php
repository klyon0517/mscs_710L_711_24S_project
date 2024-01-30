<?php

  /*  Metrics Project

      * Software: Project
      * Marist Class: MSCS_710L_711_24S
      * Filename: post_phpsysinfo_json.php
      * Author: Kerry Lyon
      * Created: January 29, 2024
      * This file inserts the phpsysinfo metrics into the database.

  */
  
  date_default_timezone_set("America/New_York");
  
  try {
    
    // Insert metrics after they have been retrived
    
  } catch (PDOException $mariadbErr) {
    
    $errDate = date("Y-m-d H:i:s");
    $error_type = "MariaDB";
    $method = "INSERT";
    $file = "post_phpsysinfo_json";
    $message = "Unable to insert system metrics into the databse.";
    $error = $e->mariadbErr();
    $file_pointer = "../logs/mariadb_error.log";
    
    require '../error/error_write.php';  
    
  }

?>