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
		<title>Metrics Project</title>
				
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
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">
          <i class="fa-solid fa-rocket"></i>
          MSCS_710L_711_24S PROJECT
        </span>
      </div>
    </nav>
    <button type="button" class="btn btn-primary" onclick="getMetrics()">Metrics</button>
    <div id="metrics" class="container-lg">Performance?</div>
    <div style="height: 200px; width: 200px">
      <canvas id="myChart"></canvas>
    </div>

    
    <!-- Custom Script -->   
		<script type="text/javascript" src="scripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    
  </body>
</html>