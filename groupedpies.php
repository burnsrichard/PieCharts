<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PieCharts</title>

	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php	// must first forward local port to bones via taz
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
	<div id="header">Grouped Pie Charts</div> <br> 
					<a href="index.php">Corpus</a> | 
					<a href="groupedpies.php">Grouped Pie Charts</a>
	</div>

	<table>
    <tr>
        <th>Index</th>
        <th>Id</th>  
        <th>Text</th>
        <th>Components</th>
    </tr>
    <?php
    	try {
			//Create connection
			$dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
		} catch (PDOException $e) {
    		print "Error!: " . $e->getMessage() . "<br/>";
    		die();
    	}
    	$sql = "SELECT `Index`, `Id`, `Text`, `Components`, `File Type` FROM `GroupedPies`";
    	foreach($dbh->query($sql) as $row) {
    ?>
        <tr>
            <td><?php echo $row["Index"]?></td>
            <td><?php echo $row["Id"]?></td> 
            <td><?php echo $row["Text"]?></td>
            <td><?php $string = $row["Components"];
            		  $components = explode(',', $string);
            		  $whichpiechart = explode('-', $string);
            		  $filename = $whichpiechart[0];
            		  echo count($components) . " pie charts <br>";
            		  if($row["File Type"] == "pdf") {
            			echo '<a href= "images/'.$filename.'.pdf">pdf link</a>';
            		  }
            		  else {
            			echo '<a href ="images/'.$filename.'.'.$row["File Type"].'">';
            			echo '<img class="piechart" src= "images/'.$filename.'.'.$row["File Type"].'">';
            			echo '</a><br>';
            			echo '(click image to enlarge)';
            		}
            	?>		  
            </td>
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