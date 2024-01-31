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
    
    require 'mariadb/mariadb_connection.php';
    
    // Insert metrics after they have been retrived
    // header('Content-Type: application/json');
    $json = json_decode(file_get_contents("php://input"), true);
    $hostname = $json['hostname'];
    $date = date("Y-m-d H:i:s");
        
    $stmt = $mariadb_conn->prepare(
      "INSERT INTO metrics
        (date,
        hostname)
      VALUES
        (:date,
        :hostname)");
    $stmt->bindParam("date", $date, PDO::PARAM_STR);
    $stmt->bindParam("hostname", $hostname, PDO::PARAM_STR);
    $stmt->execute();
    
    $arr = array("success"=>"yes");
    echo json_encode($arr);
    
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