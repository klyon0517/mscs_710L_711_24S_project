<?php

  /*  Metrics Project

      * Software: Project
      * Marist Class: MSCS_710L_711_24S
      * Filename: get_fifteen_min_avg_json.php
      * Author: Kerry Lyon
      * Created: March 3, 2024
      * This file selects and averages 15 minutes of metrics data.
      * It then saves to a table for future calculations and deletes the old data.
      * Finally it returns the averages in json format.

  */
  
  date_default_timezone_set("America/New_York");

  try {
        
    require 'mariadb_connection.php';
    
    try {
      
      $stmt = $mariadb_conn->prepare(
        "SELECT
          cpu_load,
          memory_load,
          storage_used
        FROM metrics
        WHERE date >= CONVERT_TZ(NOW(), '+00:00', '-05:00') - INTERVAL 15 MINUTE");
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      if(!empty($result)) {
      // if (isset($result[0]['memory_load']) {
        
        $num = count($result);
        $cpu_load_total = 0;
        $memory_load_total = 0;
        $storage_used_total = 0;
        
        foreach($result as $row) {
        
          $cpu_load_total += $row['cpu_load'];
          $memory_load_total += $row['memory_load'];
          $storage_used_total += $row['storage_used'];
      
        }
        
        $cpu_load_avg = round($cpu_load_total / $num);
        $memory_load_avg = round($memory_load_total / $num);
        $storage_used_avg = round($storage_used_total / $num);
        
        try {
      
          $date = date("Y-m-d H:i:s");
        
          $stmt = $mariadb_conn->prepare(
            "INSERT INTO fifteen_min_average
              (date,
              fifteen_min_cpu_avg,
              fifteen_min_memory_avg,
              fifteen_min_storage_avg)
            VALUES
              (:date,
              :fifteen_min_cpu_avg,
              :fifteen_min_memory_avg,
              :fifteen_min_storage_avg)");
          $stmt->bindParam("date", $date, PDO::PARAM_STR);
          $stmt->bindParam("fifteen_min_cpu_avg", $cpu_load_avg, PDO::PARAM_STR);
          $stmt->bindParam("fifteen_min_memory_avg", $memory_load_avg, PDO::PARAM_STR);
          $stmt->bindParam("fifteen_min_storage_avg", $storage_used_avg, PDO::PARAM_STR);
          $stmt->execute();
          
        } catch (PDOException $mariadbErr) {
          
          $errDate = date("Y-m-d H:i:s");
          $error_type = "MariaDB";
          $method = "INSERT";
          $file = "get_fifteen_min_avg_json";
          $message = "Unable to insert the 15 minutes metrics averages into the fifteen_min_average table.";
          $error = $e->mariadbErr();
          $file_pointer = "../logs/mariadb_error.log";
        
          require '../error/error_write.php';
          echo "Failed. Error message: " . $error . "\n\n";
          
        }
        
      } else {
        
        $cpu_load_avg = "0";
        $memory_load_avg = "0";
        $storage_used_avg = "0";
        
      }
      
    } catch (PDOException $mariadbErr) {
      
      $errDate = date("Y-m-d H:i:s");
      $error_type = "MariaDB";
      $method = "SELECT";
      $file = "get_fifteen_min_avg_json";
      $message = "Unable to select 15 minutes worth of metrics from the metrics table.";
      $error = $e->mariadbErr();
      $file_pointer = "../logs/mariadb_error.log";
    
      require '../error/error_write.php';
      echo "Failed. Error message: " . $error . "\n\n";
      
    }
    
    try {
    
      $stmt = $mariadb_conn->prepare(
        "DELETE FROM metrics
        WHERE date >= CONVERT_TZ(NOW(), '+00:00', '-05:00') - INTERVAL 15 MINUTE");
      $stmt->execute();
      
    } catch (PDOException $mariadbErr) {
          
      $errDate = date("Y-m-d H:i:s");
      $error_type = "MariaDB";
      $method = "DELETE";
      $file = "get_fifteen_min_avg_json";
      $message = "Unable to delete the metrics from the metrics table.";
      $error = $e->mariadbErr();
      $file_pointer = "../logs/mariadb_error.log";
    
      require '../error/error_write.php';
      echo "Failed. Error message: " . $error . "\n\n";
      
    }
    
    $fifteen_min_avg = array(
      "fifteen_min_cpu_avg" => $cpu_load_avg,
      "fifteen_min_memory_avg" => $memory_load_avg,
      "fifteen_min_storage_avg" => $storage_used_avg);

    echo json_encode($fifteen_min_avg);
      
    $mariadb_conn = null;
    
  } catch (Exception $e) {
    
    $errDate = date("Y-m-d H:i:s");
    $error_type = "GET";
    $method = "averages";
    $file = "get_fifteen_min_avg_json";
    $message = "Failed to average 15 minutes of metrics data.";
    $error = $e->getMessage();
    $file_pointer = "../logs/php_error.log";
    
    require '../error/error_write.php';
    echo "Failed. Error message: " . $error . "\n\n";
    
  }

?>