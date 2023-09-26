# Landscaping
1.Unzip the Mini-project folder.

Setup Instructions:
1. Download and setup the latest stable release of XAMPP/LAMPP/MAMPP/WAMPP from [here](https://www.apachefriends.org/download.html) depending on your OS.

2. Copy the Mini-project folder into the htdocs folder in C.

3. Edit the db.php file in the main directory. This file contains connection details like db_name,dp_pass, etc.
## Setup the connection variables(in connectVars.php):
- DB_HOST - Url of the SQL database server
- DB_USER - Username
- DB_PASSWORD - Password
- DB_NAME - Name of the database

4. Create a new database named gardener in phpmyadmin and import gardener.sql into it.

. Change the admin details in gardener.sql. As of now default admin is created with username as 'miniproject' and password as '12345'

For every gardener the password is 12345 only. You can see the usernames from the table gardener.



## Steps to start:
- Start your XAMPP server.
- Go to http://localhost/Mini-Project/ on your browser to open the portal.
