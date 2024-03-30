<?php

  date_default_timezone_set("America/New_York");
  
  try {
    
      require 'mariadb_connection.php';
      
      $date = date("Y-m-d H:i:s");
      
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
          'EC2AMAZ-1HQHP5U',
          'Microsoft Windows Server 2022 Datacenter',
          '10.0.20348.2227 (64-bit) x64',
          '1 days 40 mins',
          'AWS PV Network Device #0',
          '172.31.25.238',
          '160.72 MB',
          '19.28 MB',
          '17',
          '83',
          '93',
          '7',
          '62',
          '38')");
      $stmt->bindParam("date", $date, PDO::PARAM_STR);
      $stmt->execute();
      
      echo "INSERT successful.";
      
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
      echo "Failed. Error message: " . $message;
      
    }

?>