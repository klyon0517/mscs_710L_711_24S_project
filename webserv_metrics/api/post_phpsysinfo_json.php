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
    $distro = $json['distro'];
    $kernal = $json['kernal'];
    $uptime = $json['uptime'];
    $network_name = $json['network_name'];
    $ip_address = $json['ip_address'];
    $received_mb = $json['received_mb'];
    $sent_mb = $json['sent_mb'];
    $cpu_load = $json['cpu_load'];
    $cpu_free = $json['cpu_free'];
    $memory_load = $json['memory_load'];
    $memory_free = $json['memory_free'];
    $storage_used = $json['storage_used'];
    $storage_free = $json['storage_free'];
    $date = date("Y-m-d H:i:s");
    
    try {
    
      require 'mariadb_connection.php';
      
      $stmt = $mariadb_conn->prepare(
        "INSERT INTO metrics
          (date,
          hostname,
          distro,
          kernal,
          uptime,
          network_name,
          ip_address,
          received_mb,
          sent_mb,
          cpu_load,
          cpu_free,
          memory_load,
          memory_free,
          storage_used,
          storage_free)
        VALUES
          (:date,
          :hostname,
          :distro,
          :kernal,
          :uptime,
          :network_name,
          :ip_address,
          :received_mb,
          :sent_mb,
          :cpu_load,
          :cpu_free,
          :memory_load,
          :memory_free,
          :storage_used,
          :storage_free)");
      $stmt->bindParam("date", $date, PDO::PARAM_STR);
      $stmt->bindParam("hostname", $hostname, PDO::PARAM_STR);
      $stmt->bindParam("distro", $distro, PDO::PARAM_STR);
      $stmt->bindParam("kernal", $kernal, PDO::PARAM_STR);
      $stmt->bindParam("uptime", $uptime, PDO::PARAM_STR);
      $stmt->bindParam("network_name", $network_name, PDO::PARAM_STR);
      $stmt->bindParam("ip_address", $ip_address, PDO::PARAM_STR);
      $stmt->bindParam("received_mb", $received_mb, PDO::PARAM_STR);
      $stmt->bindParam("sent_mb", $sent_mb, PDO::PARAM_STR);
      $stmt->bindParam("cpu_load", $cpu_load, PDO::PARAM_STR);
      $stmt->bindParam("cpu_free", $cpu_free, PDO::PARAM_STR);
      $stmt->bindParam("memory_load", $memory_load, PDO::PARAM_STR);
      $stmt->bindParam("memory_free", $memory_free, PDO::PARAM_STR);
      $stmt->bindParam("storage_used", $storage_used, PDO::PARAM_STR);
      $stmt->bindParam("storage_free", $storage_free, PDO::PARAM_STR);
      $stmt->execute();
      
      $mariadb_conn = null;
      
    } catch (PDOException $mariadbErr) {
      
      $errDate = date("Y-m-d H:i:s");
      $error_type = "MariaDB";
      $method = "INSERT";
      $file = "post_phpsysinfo_json";
      $message = "Unable to insert system metrics into the metrics table.";
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