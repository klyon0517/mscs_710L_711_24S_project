<?php

 /*  Metrics Project

      * Software: Project
      * Marist Class: MSCS_710L_711_24S
      * Filename: metrics_data_test.php
      * Author: Kerry Lyon
      * Created: March 30, 2024
      * This file contains the test json payload.

  */

  $metrics_test_arr = array(
    "hostname"=>"EC2AMAZ-1HQHP5U",
    "distro"=>"Microsoft Windows Server 2022 Datacenter",
    "kernal"=>"10.0.20348.2227 (64-bit) x64",
    "uptime"=>"1 days 40 mins",
    "network_name"=>"AWS PV Network Device #0",
    "ip_address"=>"172.31.25.238",
    "received_mb"=>"160.72 MB",
    "sent_mb"=>"19.28 MB",
    "cpu_load"=>"17",
    "cpu_free"=>"83",
    "memory_load"=>"93",
    "memory_free"=>"7",
    "storage_used"=>"62",
    "storage_free"=>"38"
  );
  
  $metrics_test_data = json_encode($metrics_test_arr);

?>