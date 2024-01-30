<?php

  /*  Metrics Project

      * Software: Project
      * Marist Class: MSCS_710L_711_24S
      * Filename: error_write.php
      * Author: Kerry Lyon
      * Created: January 29, 2024

      * This file writes the error to the database or
      * if the connection fails to a file.

  */

  date_default_timezone_set("America/New_York");
    
  try {
      
    // Write the error to the database.            
    require 'mariadb/mariadb_connection.php';
    
    $stmt = $mariadb_conn->prepare("INSERT INTO error_log (date, error_type, method, file, message, error) VALUES (:date, :error_type, :method, :file, :message, :error)");
    $stmt->bindParam("date", $errDate, PDO::PARAM_STR);
    $stmt->bindParam("error_type", $error_type, PDO::PARAM_STR);
    $stmt->bindParam("method", $method, PDO::PARAM_STR);
    $stmt->bindParam("file", $file, PDO::PARAM_STR);
    $stmt->bindParam("message", $message, PDO::PARAM_STR);
    $stmt->bindParam("error", $error, PDO::PARAM_STR);
    $stmt->execute();
    
    $mariadb_conn = null;
    
  } catch (PDOException $mariadbErr) {
    
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