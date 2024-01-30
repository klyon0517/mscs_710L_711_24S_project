<?php

  date_default_timezone_set("America/New_York");
  
  require 'mariadb/mariadb_connection.php';
  
  $txt =  "Date: " . date("Y-m-d H:i:s") . "\n\n";
  $file_pointer = "../logs/mariadb_error.log";
    
    if (file_exists($file_pointer)) {
      
      $error_file = fopen($file_pointer, "a") or die("Unable to open file!");
      fwrite($error_file, $txt);
      fclose($error_file);
      
    } else {
      
      $error_file = fopen($file_pointer, "w") or die("Unable to open file!");
      fwrite($error_file, $txt);
      fclose($error_file);
      
    }
  
?>