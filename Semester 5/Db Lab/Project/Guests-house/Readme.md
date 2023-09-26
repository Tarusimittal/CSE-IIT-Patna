# Guest-House
1.Unzip the guest-house folder.

Setup Instructions:
1. Download and setup the latest stable release of XAMPP/LAMPP/MAMPP/WAMPP from [here](https://www.apachefriends.org/download.html) depending on your OS.

2. Copy the Guest- House folder into the htdocs folder in C.

3. Edit the connectVars.php file in the main directory. This file contains connection details like db_name,dp_pass, etc.
## Setup the connection variables(in connectVars.php):
- DB_HOST - Url of the SQL database server
- DB_USER - Username
- DB_PASSWORD - Password
- DB_NAME - Name of the database

4. Create a new database named guesthouse in phpmyadmin and import guesthouse.sql into it.

. Change the admin details in guesthouse.sql. As of now default admin is created with username and password both set as 'admin'. 



## Steps to start:
- Start your XAMPP server.
- Go to http://localhost/Guest-House/ on your browser to open the portal.

