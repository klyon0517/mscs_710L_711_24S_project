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
        <div class="col-sm d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-server me-2"></i>
          <div id="hostname"></div>
        </div>
        <div class="col-sm d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-floppy-disk me-2"></i>
          <div id="distro"></div>
        </div>
        <div class="col-sm d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-microchip me-2"></i>
          <div id="kernal"></div>
        </div>
        <div class="col-sm d-flex justify-content-center align-items-center">
          <i class="fa-regular fa-circle-up me-2"></i>
          <div id="uptime"></div>
        </div>
      </div>
    </div>
    <div class="container-fluid fs-6 bg-secondary text-white text-center py-3">
      <div class="row">
        <div class="col-sm d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-network-wired me-2"></i>
          <div id="networkName"></div>
        </div>
        <div class="col-sm d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-ethernet me-2"></i>
          <div id="networkIpAddress"></div>
        </div>
        <div class="col-sm d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-arrow-down-short-wide me-2"></i>
          <div id="networkReceived"></div>
        </div>
        <div class="col-sm d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>
          <div id="networkSent"></div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-sm d-flex justify-content-center">
          <div id="currentCpuLoadDiv" style="height: 200px; width: 200px"></div>
        </div>
        <div class="col-sm d-flex justify-content-center">
          <div id="minCpuLoadDiv" style="height: 200px; width: 200px"></div>
        </div>
        <div class="col-sm d-flex justify-content-center">
          <div id="hourCpuLoadDiv" style="height: 200px; width: 200px"></div>
        </div>
        <div class="col-sm d-flex justify-content-center">
          <div id="dayCpuLoadDiv" style="height: 200px; width: 200px"></div>
        </div>
      </div>    
    </div>
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-sm d-flex justify-content-center">
          <div id="currentMemoryUsageDiv" style="height: 200px; width: 200px"></div>
        </div>
        <div class="col-sm d-flex justify-content-center">
          <div id="minMemoryUsageDiv" style="height: 200px; width: 200px"></div>
        </div>
        <div class="col-sm d-flex justify-content-center">
          <div id="hourMemoryUsageDiv" style="height: 200px; width: 200px"></div>
        </div>
        <div class="col-sm d-flex justify-content-center">
          <div id="dayMemoryUsageDiv" style="height: 200px; width: 200px"></div>
        </div>
      </div>    
    </div>
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-sm d-flex justify-content-center">
          <div id="currentStorageUsageDiv" style="height: 200px; width: 200px"></div>
        </div>
        <div class="col-sm d-flex justify-content-center">
          <div id="minStorageUsageDiv" style="height: 200px; width: 200px"></div>
        </div>
        <div class="col-sm d-flex justify-content-center">
          <div id="hourStorageUsageDiv" style="height: 200px; width: 200px"></div>
        </div>
        <div class="col-sm d-flex justify-content-center">
          <div id="dayStorageUsageDiv" style="height: 200px; width: 200px"></div>
        </div>
      </div>    
    </div>
    <div class="container-fluid text-end fs-6 font-monospace fixed-bottom bg-primary-subtle py-2">
      MSCS_710L_711_24S PROJECT Authors: Kerry Lyon & Rorie Reyes
    </div>
    
    <!-- Custom Script -->   
		<script type="text/javascript" src="scripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    
  </body>
</html>