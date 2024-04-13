<?php

 /*  Metrics Project

      * Software: Project
      * Marist Class: MSCS_710L_711_24S
      * Filename: file_write_test.php
      * Author: Kerry Lyon
      * Created: March 30, 2024
      * This file checks if write permissions are allowed.

  */

  date_default_timezone_set("America/New_York");
  
  $txt =  "Date: " . date("Y-m-d H:i:s") . "\n\n";
  $file_pointer = "file_write_test.log";
  
  try {
    
    if (file_exists($file_pointer)) {
      
      $test_file = fopen($file_pointer, "a") or die("Unable to open file!");
      fwrite($test_file, $txt);
      fclose($test_file);
      
      $file_info = "Success. File 'file_write_test.log' exists in tests directory.";
      
    } else {
      
      $test_file = fopen($file_pointer, "w") or die("Unable to open file!");
      fwrite($test_file, $txt);
      fclose($test_file);
      
      $file_info = "Success. File 'file_write_test.log' created in tests directory.";
      
    }
    
    echo $file_info;
    
  } catch (Exception $e) {
    
    $error = $e->getMessage();
    echo "Failed. Error message: " . $error;
    
  }
  
?>