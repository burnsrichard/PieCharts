<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Message Categories</title>

	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php

	// must first forward local port to bones via taz
	// remote connections to port 3306 are blocked
	// $ ssh -L 8306:localhost:3306 user@taz.cs.wcupa.edu
	// $ ssh -L 8306:bones:3306 user@taz.cs.wcupa.edu
	$host = "127.0.0.1";
	$port = 8306;              // forwarded port

	$dbname = "PieCharts";
	$username = "";
	$password = "";

	// username and password re-defined in external php file
	// included in .gitignore, so they're never committed into repo
	require 'credentials.php';
	?>
	<div id="header">Pie Charts</> <br> 
        <a href="index.php">Corpus</a> | 
        <a href="groupedpies.php">Grouped Pie Charts</a> |
        <a href="messages.php">Message Categories</a>
	</div>

	<table>
    <tr>
        <th>Index</th>
        <th>Message Category</th>  
        <th>Definition</th>
        <th>Example</th>
        <th>Time Stamp</th>
    </tr>
    <?php
		try {
		// Create connection
		$dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
		} catch (PDOException $e) {
    		print "Error!: " . $e->getMessage() . "<br/>";
    		die();
		}
		$sql = "SELECT * FROM `MessageCategories`";
    	foreach($dbh->query($sql) as $row) { ?>
        <tr>
            <td><?php echo $row["index"] ?></td>
            <td><?php echo $row["messageCategories"] ?></td> 
            <td><?php echo $row["message"] ?></td>
            <td><a href="piechart.php?id=<?php echo $row["pieID"]?>">
             	<?php echo $row["pieID"]; ?></a> 
            </td>
            <td><?php echo $row["time"]?></td>
        </tr>
    <?php
    }
	?>



</body>
</html>