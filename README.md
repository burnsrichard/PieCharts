# Corpus of Grouped Bar Charts #

Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
qui officia deserunt mollit anim id est laborum.

## PHP Code for Displaying Graphs in Corpus ##

Contained in this repository.

Access to `taz.cs.wcupa.edu` is required. The database exists on `taz.cs.wcupa.edu`, whose firewall
blocks access to MYSQL port 3306. However, this MYSQL port can be accessed within the CS firewall. 

Two additional things need to be specified:
1. A `credentials.php` file to specify `$username` and `$password` DB credentials:

Included in .gitignore, so they're never committed into repo.

Create credentials.php and copy contents:
//////////////////////////////////////////////////////////////////
<?php

$host = "127.0.0.1";
$port = 8306;              // forwarded port

$dbname = "PieCharts";
$username = "<username>";
$password = "<password>";

?>
/////////////////////////////////////////////////////////////////

2. port forwarding to taz. 
Remote connections to port 3306 are blocked, must first forward local port to taz.

From the command line: 
$ ssh -L 8306:localhost:3306 <username>@taz.cs.wcupa.edu
