#!/usr/bin/env python3

import os
import mysql.connector
import getpass

## Testing Build: webserv_metrics folder ##
def test_webserv_metrics(web_server):
    # Define web root directories based on the web server
    if web_server == 'Apache':
        web_root = '/Library/WebServer/Documents' if os.name == 'posix' else 'C:/Apache24/htdocs'
    elif web_server == 'Nginx':
        web_root = '/usr/share/nginx/html' if os.name == 'posix' else 'C:/nginx/html'
    elif web_server == 'IIS':
        web_root = 'C:/inetpub/wwwroot'
    else:
        print("Unsupported web server.")
        exit()

    # Check if webserv_metrics folder exists in the web root directory
    if not os.path.exists(os.path.join(web_root, 'webserv_metrics')):
        print("webserv_metrics folder not found in the web root directory.")
        exit()

    print("webserv_metrics folder found in the web root directory.")

## Testing Prerequisite and Build: Web Server ##
def test_webserver():
    print("Checking webserver")
    if os.name == 'posix':  # Mac
        web_root_apache = '/Library/WebServer/Documents'
        web_root_nginx = '/usr/share/nginx/html'
        if os.path.exists(web_root_apache):
            print("Apache web server installed.")
            web_server = 'Apache'
        elif os.path.exists(web_root_nginx):
            print("Nginx web server installed.")
            web_server = 'Nginx'
        else:
            web_server = None
    elif os.name == 'nt':  # Windows
        web_root_apache = 'C:/Apache24/htdocs'
        web_root_nginx = 'C:/nginx/html'
        web_root_iis = 'C:/inetpub/wwwroot'
        if os.path.exists(web_root_apache):
            print("Apache web server installed.")
            web_server = 'Apache'
        elif os.path.exists(web_root_nginx):
            print("Nginx web server installed.")
            web_server = 'Nginx'
        elif os.path.exists(web_root_iis):
            print("IIS web server installed.")
            web_server = 'IIS'
        else:
            web_server = None
    else:
        print("Unsupported OS.")
        exit()

    if not web_server:
        print("Web server not found.")
        exit()

    # Test webserv_metrics folder existence
    test_webserv_metrics(web_server)

## Testing Prerequisite: phpsysinfo ##

## Testing Prerequisite: PHP ##

## Testing Prerequisite: MariaDB ##
def test_mariadb_connection(host, user, password, database):
    try:
        conn = mysql.connector.connect(
            host=host,
            user=user,
            password=password,
            database=database
        )
        print("MariaDB connection successful!")
        conn.close()
        return True
    except mysql.connector.Error as e:
        print(f"Error connecting to MariaDB: {e}")
        return False

mariadb_host = input("Enter MariaDB server name (default is localhost): ")
if not mariadb_host:
    mariadb_host = 'localhost'

mariadb_username = input("Enter MariaDB username: ")
mariadb_password = getpass.getpass("Enter MariaDB password: ")
mariadb_database = 'metrics_project'
test_webserver()
test_mariadb_connection(mariadb_host, mariadb_username, mariadb_password, mariadb_database)
