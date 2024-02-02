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
    
    $json = json_decode(urldecode(file_get_contents("php://input")), true);
    $hostname = $json['hostname'];
    $cpuModel = $json['cpuModel'];
    $cpuLoad = $json['cpuLoad'];
    $date = date("Y-m-d H:i:s");
    
    try {
    
      require 'mariadb/mariadb_connection.php';
      
      $stmt = $mariadb_conn->prepare(
        "INSERT INTO metrics
          (date,
          hostname,
          cpu_model,
          cpu_load)
        VALUES
          (:date,
          :hostname,
          :cpu_model,
          :cpu_load)");
      $stmt->bindParam("date", $date, PDO::PARAM_STR);
      $stmt->bindParam("hostname", $hostname, PDO::PARAM_STR);
      $stmt->bindParam("cpu_model", $cpuModel, PDO::PARAM_STR);
      $stmt->bindParam("cpu_load", $cpuLoad, PDO::PARAM_STR);
      $stmt->execute();
      
      $mariadb_conn = null;
      
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
    
    $arr = array("success"=>"SUCCESS");
    echo json_encode($arr);
    
  } catch (Exception $e) {
    
    $errDate = date("Y-m-d H:i:s");
    $error_type = "POST";
    $method = "file_get_contents";
    $file = "post_phpsysinfo_json";
    $message = "Failed to parse posted json.";
    $error = $e->getMessage();
    $file_pointer = "../logs/php_error.log";
    
    require '../error/error_write.php';  
    
  }

?>