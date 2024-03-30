<?php

  echo "-----PHP TEST SUITE-----
        This script automates the testing of the following:
        -- database connection
        -- file write
        -- POST phpsysinfo API
        -- GET 15 min avg API
        -- GET 1 hour avg API
        -- GET 1 day avg API\n\n";
        
  echo "-----Testing metrics_project database connection-----\n";  
  require 'tests/connection_test.php';
  
  echo "-----Testing file write-----\n";
  require 'tests/file_write_test.php';
  
  echo "-----Testing POST API-----\n";
  echo "Filename: post_phpsysinfo_json.php\n";
  // need to work out how to pass parameters
  // from here to file_get_contents
  // require 'api/post_phpsysinfo_json.php';
  
  echo "-----Testing GET API-----\n";
  echo "Filename: get_fifteen_min_avg_json.php\n";
  echo "Insert test data info 'metrics' table.\n";
  require 'tests/insert_metrics_data_test.php';
  echo "Executing the API\n";
  echo "Returned payload: ";
  require 'api/get_fifteen_min_avg_json.php';



?>