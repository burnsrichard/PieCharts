<?php

// must first forward local port to bones via taz
// remote connections to port 3306 are blocked
// $ ssh -L 8306:bones:3306 user@taz.cs.wcupa.edu
$host = "127.0.0.1";
$port = 8306;              // forwarded port

$dbname = "PieCharts";
$username = "";
$password = "";

// username and password re-defined in external php file
// included in .gitignore, so they're never committed into repo
require 'credentials.php';

try {

	// Create connection
	$dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

	$sql = "SELECT `Index`, `Id`, `Date` FROM `Corpus`";
    foreach($dbh->query($sql) as $row) {
        // print_r($row);
        echo "Index: " . $row["Index"]. " - Id: " . $row["Id"]. " - Date: " . $row["Date"]. "<br>";
    }

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


// close the connection
$dbh = null;
?> 