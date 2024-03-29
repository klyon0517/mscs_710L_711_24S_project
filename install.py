#!/usr/bin/env python3

import os
import shutil
import getpass
import subprocess

# Check if prerequisites are downloaded
prerequisites_downloaded = input("Have you downloaded the prerequisites (phpsysinfo, web server, MariaDB, PHP)? (y/n): ")

if prerequisites_downloaded.lower() != 'y':
    print("Please download the prerequisites before continuing.")
    exit()

# Determine the web server installed and find the web root path
web_server = input("Which web server is installed (Apache, Nginx, IIS)? ")
if web_server.lower() == 'apache':
    if os.name == 'posix':  # Mac
        web_root = '/Library/WebServer/Documents'
    elif os.name == 'nt':  # Windows
        web_root = 'C:/Apache24/htdocs'  # Adjust this path for different systems
    else:
        print("Unsupported OS.")
        exit()
elif web_server.lower() == 'nginx':
    if os.name == 'posix':  # Mac
        web_root = '/usr/share/nginx/html'
    elif os.name == 'nt':  # Windows
        web_root = 'C:/nginx/html'  # Adjust this path for different systems
    else:
        print("Unsupported OS.")
        exit()
elif web_server.lower() == 'iis':
    if os.name == 'nt':  # Windows
        web_root = 'C:/inetpub/wwwroot'
    else:
        print("Unsupported OS.")
        exit()
else:
    print("Unsupported web server.")
    exit()

# Copy the webserv_metrics folder into the web root directory
shutil.copytree('webserv_metrics', os.path.join(web_root, 'webserv_metrics'))

# Prompt for MariaDB information
mariadb_servername = input("Enter MariaDB server name (default is localhost): ")
if not mariadb_servername:
    mariadb_servername = 'localhost'

mariadb_username = input("Enter MariaDB username: ")
mariadb_password = getpass.getpass("Enter MariaDB password: ")

# Modify mariadb_connection.php to include the MariaDB information
mariadb_connection_path = 'includes/mariadb_connection.php'
with open(mariadb_connection_path, 'r') as f:
    lines = f.readlines()

with open(mariadb_connection_path, 'w') as f:
    for line in lines:
        if '$mariadb_servername =' in line:
            line = f"$mariadb_servername = '{mariadb_servername}';\n"
        elif '$mariadb_username =' in line:
            line = f"$mariadb_username = '{mariadb_username}';\n"
        elif '$mariadb_password =' in line:
            line = f"$mariadb_password = '{mariadb_password}';\n"
        f.write(line)

# Create the metrics_project database and import the SQL file
try:
    subprocess.run(['mysql', '-h', mariadb_servername, '-u', mariadb_username, '-p' + mariadb_password, '-e', 'CREATE DATABASE IF NOT EXISTS metrics_project'])
    subprocess.run(['mysql', '-h', mariadb_servername, '-u', mariadb_username, '-p' + mariadb_password, 'metrics_project', '-e', 'source metrics_db_sql_import.sql'])
    print("Database created and SQL file imported successfully.")
except subprocess.CalledProcessError as e:
    print("Error:", e)
    exit()

print("Setup complete.")
