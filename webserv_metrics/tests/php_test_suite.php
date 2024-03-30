<?php

  echo "\n-----PHP TEST SUITE-----
        This script automates the testing of the following:
        -- database connection
        -- file write
        -- POST phpsysinfo API
        -- GET 15 min avg API
        -- GET 1 hour avg API
        -- GET 1 day avg API\n\n";
        
  echo "-----Testing metrics_project database connection-----\n";  
  require 'connection_test.php';
  
  echo "-----Testing file write-----\n";
  require 'file_write_test.php';
  
  echo "-----Testing POST API-----\n";
  echo "Filename: post_phpsysinfo_json.php\n";
  echo "Sample metrics data:\n";
  require 'metrics_data_test.php';
  echo $metrics_test_data . "\n";
  echo "Executing the API\n";
  echo "Returned payload: ";
  require '../api/post_phpsysinfo_json.php';
  echo "\n\n";
  
  echo "-----Testing GET FIFTEEN MIN AVG API-----\n";
  echo "Filename: get_fifteen_min_avg_json.php\n";
  echo "Executing the API\n";
  echo "Returned payload: ";
  require '../api/get_fifteen_min_avg_json.php';
  echo "\n\n";
  
  echo "-----Testing GET ONE HOUR AVG API-----\n";
  echo "Filename: get_one_hour_avg_json.php\n";
  echo "Executing the API\n";
  echo "Returned payload: ";
  require '../api/get_one_hour_avg_json.php';
  echo "\n\n";
  
  echo "-----Testing GET ONE DAY AVG API-----\n";
  echo "Filename: get_one_day_avg_json.php\n";
  echo "Executing the API\n";
  echo "Returned payload: ";
  require '../api/get_one_day_avg_json.php';
  echo "\n";

?>