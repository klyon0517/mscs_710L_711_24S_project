#!/usr/bin/env python3

import os
import mysql.connector
import getpass
import subprocess
import logging
import sys

# Configure logging
logging.basicConfig(filename='output_file.log', level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

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
        logging.error("Unsupported web server.")
        exit(1)

    # Check if webserv_metrics folder exists in the web root directory
    if not os.path.exists(os.path.join(web_root, 'webserv_metrics')):
        logging.error("webserv_metrics folder not found in the web root directory.")
        sys.exit(1)

    logging.info("webserv_metrics folder found in the web root directory.")

## Testing Prerequisite and Build: Web Server ##
def test_webserver():
    logging.info("Checking webserver")
    if os.name == 'posix':  # Mac
        web_root_apache = '/Library/WebServer/Documents'
        web_root_nginx = '/usr/share/nginx/html'
        if os.path.exists(web_root_apache):
            logging.info("Apache web server installed.")
            web_server = 'Apache'
        elif os.path.exists(web_root_nginx):
            logging.info("Nginx web server installed.")
            web_server = 'Nginx'
        else:
            logging.error("Web server not found.")
            sys.exit(1)
    elif os.name == 'nt':  # Windows
        web_root_apache = 'C:/Apache24/htdocs'
        web_root_nginx = 'C:/nginx/html'
        web_root_iis = 'C:/inetpub/wwwroot'
        if os.path.exists(web_root_apache):
            logging.info("Apache web server installed.")
            web_server = 'Apache'
        elif os.path.exists(web_root_nginx):
            logging.info("Nginx web server installed.")
            web_server = 'Nginx'
        elif os.path.exists(web_root_iis):
            logging.info("IIS web server installed.")
            web_server = 'IIS'
        else:
            logging.error("Web server not found.")
            sys.exit(1)
    else:
        logging.error("Unsupported OS.")
        sys.exit(1)

    # Test webserv_metrics folder existence
    test_webserv_metrics(web_server)

## Testing Prerequisite: PHP ##
def test_php():
    try:
        output = subprocess.check_output(['php', '-v'], stderr=subprocess.STDOUT, text=True)
        if 'PHP' in output:
            logging.info("PHP is installed.")
        else:
            raise Exception("PHP not installed.")
    except subprocess.CalledProcessError as e:
        raise Exception("PHP not installed.")

## Testing Prerequisite: MariaDB ##
def test_mariadb_connection(host, user, password, database):
    try:
        conn = mysql.connector.connect(
            host=host,
            user=user,
            password=password,
            database=database
        )
        logging.info("MariaDB connection successful!")
        conn.close()
    except mysql.connector.Error as e:
        raise Exception(f"Error connecting to MariaDB: {e}")

mariadb_host = input("Enter MariaDB server name (default is localhost): ")
if not mariadb_host:
    mariadb_host = 'localhost'

mariadb_username = input("Enter MariaDB username: ")
mariadb_password = getpass.getpass("Enter MariaDB password: ")
mariadb_database = 'metrics_project'

try:
    test_webserver()
    test_php()
    test_mariadb_connection(mariadb_host, mariadb_username, mariadb_password, mariadb_database)

    # Run PHP test script
    subprocess.run(['php', 'php_test_suite.php'])

    print("All tests passed.")
    logging.info("All tests passed.")
except Exception as e:
    print(f"Test failed: {e}")
    logging.error(f"Test failed: {e}")
    sys.exit(1)
