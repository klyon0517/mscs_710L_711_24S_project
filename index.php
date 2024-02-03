<!--  Metrics Project

      * Software: Project
      * Marist Class: MSCS_710L_711_24S
      * Filename: index.php
      * Author: Kerry Lyon
      * Created: Janurary 28, 2024

      * This file contains the main content layout for the metrics project app.

-->

<!DOCTYPE html>
<html>
	<head>
  
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Metric Project" />
    <meta name="keywords" content="metrics, computer, marist, class, cpu, memory" />
    <meta name="author" content="klyon" />
		
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<title>WebServ Metrics</title>
				
		<!-- CSS -->
		<!-- <link rel="stylesheet" type="text/css" href="css/styles.css"> -->
		
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		
		<!-- Font Awesome -->
		<script src="https://kit.fontawesome.com/a0ae6b9fc2.js" crossorigin="anonymous"></script>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            
  </head>
  <body>
    <nav class="navbar bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">
          <i class="fa-solid fa-chart-simple me-2"></i>
          WebServ Metrics
        </span>
      </div>
    </nav>
    <div class="container-fluid fs-6 font-monospace text-white text-center bg-primary py-3">
      <div class="row">
        <div id="hostname" class="col-sm">
          <i class="fa-solid fa-server"></i>
          EC2AMAZ-1HQHP5U
        </div>
        <div id="distro" class="col-sm">
          <i class="fa-solid fa-floppy-disk"></i>
          Microsoft Windows Server 2022 Datacenter
        </div>
        <div id="kernal" class="col-sm">
          <i class="fa-solid fa-microchip"></i>
          10.0.20348.2227 (64-bit) x64
        </div>
        <div id="uptime" class="col-sm">
          <i class="fa-regular fa-circle-up"></i>
          5 days 10 hrs 35 mins
        </div>
      </div>
    </div>
    <div class="container-fluid fs-6 bg-secondary text-white text-center py-3">
      <div class="row">
        <div id="networkName" class="col-sm">
          <i class="fa-solid fa-network-wired"></i>
          AWS PV Network Device #0
        </div>
        <div id="networkIpAddress" class="col-sm">
          <i class="fa-solid fa-ethernet"></i>
          172.31.25.238
        </div>
        <div id="networkReceived" class="col-sm">
          <i class="fa-solid fa-arrow-down-short-wide"></i>
          928.70 MiB
        </div>
        <div id="networkSent" class="col-sm">
          <i class="fa-solid fa-arrow-up-from-bracket"></i>
          438.99 MiB
        </div>
      </div>
    </div>
    <!-- <div class="container-fluid fs-6 text-center py-3">
      <div class="row">
        <div class="col-sm">
          Current
        </div>
        <div class="col-sm">
          15 mins
        </div>
        <div class="col-sm">
          1 hr
        </div>
        <div class="col-sm">
          1 day
        </div>
      </div>
    </div> -->
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="currentCpuLoad" class="border p-3"></canvas>
        </div>
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="minCpuLoad" class="p-3"></canvas>
        </div>
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="hourCpuLoad" class="p-3"></canvas>
        </div>
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="dayCpuLoad" class="p-3"></canvas>
        </div>
      </div>    
    </div>
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="currentMemoryUsage" class="border p-3"></canvas>
        </div>
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="minMemoryUsage" class="p-3"></canvas>
        </div>
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="hourMemoryUsage" class="p-3"></canvas>
        </div>
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="dayMemoryUsage" class="p-3"></canvas>
        </div>
      </div>    
    </div>
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="currentStorageUsage" class="border p-3"></canvas>
        </div>
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="minStorageUsage" class="p-3"></canvas>
        </div>
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="hourStorageUsage" class="p-3"></canvas>
        </div>
        <div class="col-sm d-flex justify-content-center" style="height: 200px; width: 200px">
          <canvas id="dayStorageUsage" class="p-3"></canvas>
        </div>
      </div>    
    </div>
    <div class="container-fluid text-end fs-6 font-monospace fixed-bottom bg-primary-subtle py-2">
      MSCS_710L_711_24S PROJECT Authors: Kerry Lyon & Rorie Reyes
    </div>
    
    
    <!-- <nav class="navbar fixed-bottom bg-body-tertiary" style="background-color: #e3f2fd;">
      <div class="container-fluid">
        <span class="navbar-brand mb-0">
          MSCS_710L_711_24S PROJECT
        </span>
      </div>
    </nav> --> 
    
    
    <!-- <div style="height: 200px; width: 200px">
      <canvas id="myChart"></canvas>
    </div> -->

    
    <!-- Custom Script -->   
		<script type="text/javascript" src="scripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    
  </body>
</html>