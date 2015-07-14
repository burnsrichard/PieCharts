<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PieCharts</title>

	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php

// must first forward local port to bones via taz
// remote connections to port 3306 are blocked
// $ ssh -L 8306:localhost:3306 user@taz.cs.wcupa.edu
$host = "127.0.0.1";
$port = 8306;              // forwarded port

$dbname = "PieCharts";
$username = "";
$password = "";

// username and password re-defined in external php file
// included in .gitignore, so they're never committed into repo
require 'credentials.php';
?>
<div id="header">Pie Charts - Corpus</div>
<table>
    <tr>
        <th>Index</th>
        <th>Id</th>  
        <th>Date</th>
        <th>Source</th>
    </tr>
<?php
try {

	// Create connection
	$dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
	$sql = "SELECT `Index`, `Id`, `Date`, `Source` FROM `Corpus`";
    foreach($dbh->query($sql) as $row) {
    ?>
        <tr>
            <td><?php echo $row["Index"]?></td>
            <td><a href="piechart.php?id=<?php echo $row["Id"]?>"><?php echo $row["Id"]?></a></td> 
            <td><?php echo $row["Date"]?></td>
            <td><?php echo $row["Source"]?></td>
        </tr>
    <?php
    }
    ?>
</table>
<?php
// close the connection
$dbh = null;
?>
</body>
</html>