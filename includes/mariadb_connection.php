<?php

  /*  Metrics Project

      * Software: Project
      * Marist Class: MSCS_710L_711_24S
      * Filename: mariadb_connection.php
      * Author: Kerry Lyon
      * Created: January 29, 2024

      * This file contains the connection information to the MariaDB database.

  */

  date_default_timezone_set("America/New_York");

  try {
    
    $mariadb_servername = "";
    $mariadb_username = "";
    $mariadb_password = "";
    $mariadb_dbname= "metrics_project";

    $mariadb_conn = new PDO("mysql:host=$mariadb_servername;dbname=$mariadb_dbname", $mariadb_username, $mariadb_password);
      
    // Set the PDO error mode to exception  
    $mariadb_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $connection_status = "Success";
    
  } catch(PDOException $mariadbErr) {
    
    $connection_status = "Failure";
    
    $errDate = date("Y-m-d H:i:s");
    $error_type = "PDO";
    $method = "connect";
    $file = "mariadb_connection";
    $message = "Unable to open a connection to the database.";
    $error = $e->mariadbErr();
    $file_pointer = "../logs/mariadb_error.log";
    
    // If the connection to the database fails, write the error to a log file.                
    $txt =  "Date: " . $errDate . "\n" .
            "Error Type: " . $error_type . "\n" .
            "Method: " . $method . "\n" .
            "File: " . $file . "\n" . 
            "Message: " . $message . "\n" . 
            "Error: " . $error . "\n" . 
            "Database Error: " . $mariadbErr . "\n\n";
    
    if (file_exists($file_pointer)) {
      
      $error_file = fopen($file_pointer, "a") or die("Unable to open file!");
      fwrite($error_file, $txt);
      fclose($error_file);
      
    } else {
      
      $error_file = fopen($file_pointer, "w") or die("Unable to open file!");
      fwrite($error_file, $txt);
      fclose($error_file);
      
    }
    
  }

?>