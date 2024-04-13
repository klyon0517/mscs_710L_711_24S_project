<?php

 /*  Metrics Project

      * Software: Project
      * Marist Class: MSCS_710L_711_24S
      * Filename: connection_test.php
      * Author: Kerry Lyon
      * Created: March 30, 2024
      * This file checks the connection to the database.

  */

  date_default_timezone_set("America/New_York");
  
  require 'mariadb_connection.php';
  
  echo $connection_status;
    
?>