# Corpus  of PieCharts #

Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
qui officia deserunt mollit anim id est laborum.

## Localhost access for PieCharts directory. ##

Localhost access.

These instructions are designed for setting up and running "PieCharts" on your local machine 
through apache, mamp or service of your choice. See below to set up taz.cs.wcupa.edu as the 
server.

Clone the PieCharts repository from https://github.com/burnsrichard/PieCharts

$ git clone https://github.com/burnsrichard/PieCharts

Create "credentials.php" file in the PieCharts directory to specify "$username" and "$password" 
database credentials. These credentails are for the MySQL database and differ from the 
taz.cs.wcupa.edu credentails. This file is included in .gitignore of the PieCharts repository. 
This file, with your personal credentials, will not be committed into the repo.

Access to taz.cs.wcupa.edu is required. The database exists on taz.cs.wcupa.edu, whose firewall
blocks access to MySQL port 3306. You must port forward to access the database. 

Copy contents into "credentials.php":

//////////////////////////////////////////////////////////////////
<?php

$host = "127.0.0.1";
$port = 8306;              // forwarded port

//taz MySQL credentials
$dbname = "PieCharts";
$username = "<mysql_username>";
$password = "<mysql_password>";

?>

/////////////////////////////////////////////////////////////////

Port forwarding to taz. 
Remote connections to port 3306 are blocked. You must forward local port 8306 to taz.

From the command line: 
$ ssh -L 8306:localhost:3306 <taz_username>@taz.cs.wcupa.edu
<taz_password>

Once the connection to the database is established, the PieChart directory and database links 
should render on your localhost.


## Using taz.cs.wcupa.edu as server for PieCharts. ##


These instructions are designed for using the server taz.cs.wcupa.edu to run the PieCharts directory.

Log into taz with your crdentials:
$ ssh <taz_username>@taz.cs.wcupa.edu

Create a public_html directory:
@taz$ mkdir public_html

cd into the public_html directory.
@taz$ cd public_html

The git version control system is installed on taz.
Clone the PieCharts repository from https://github.com/burnsrichard/PieCharts

@taz:~/public_html$ git clone https://github.com/burnsrichard/PieCharts

cd into the PieCharts directory.

@taz:~/public_html$ cd PieCharts

Create "credentials.php" file to specify "$username" and "$password" DB credentials. These
credentails are for the MySQL database and differ from the taz.cs.wcupa.edu credentails.
This file is included in .gitignore of the PieCharts repository. This file, with your personal
credentials, will not be committed into the repo. Nano is the default command line text editor 
on taz.

@taz:~/public_html/PieCharts$ touch credentials.php

@taz:~/public_html/PieCharts$ nano credentials.php

**Notice we are using port 3306.** Copy contents:
-------------------------------------------------
<?php

$host = "127.0.0.1";
$port = 3306;            

//taz MySQL credentials			
$dbname = "PieCharts";
$username = "<mysql_username>";
$password = "<mysql_password>";

?>
--------------------------------------------------
To save the file press ctl+0. Press enter to confirm and then exit nano with ctl+x.

The PieCharts link should now be accessible at taz.cs.wcup.edu/~<taz_username>
