<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php 
		// From the pie chart id, get only the filename
		$id = filter_input(INPUT_GET, 'id');
		$string = explode('-', $id);
		$filename = $string[0];

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
		<div id="header">Pie Chart - <?php echo $id; ?> 
						<br> <a href="index.php">Corpus</a> | 
						<a href="groupedpies.php">Grouped Pie Charts</a>
						<a href="groupedpies.php">Grouped Pie Charts</a> |
        				<a href="messages.php">Message Categories</a>
		</div>
		<div id="piechartinfo">
		<?php
		// Create connection
		$dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
		$sql = "SELECT * FROM `Corpus` WHERE `Id` = :id";
		$statement = $dbh->prepare($sql);
		$statement->bindValue(':id', $id);
		$statement->execute();
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		if($row === false){
    		echo $id . ' not found!';
		} else{
			if($row["Date"] == null) {
                echo "date unknown";
            }else 
                echo $row["Date"];
                echo " | " . $row["Source"] . "<br>";
        	    echo "<h3>" . $row["Headline"] . "</h3>" . $row["HeadlineText"] . "<br>";
                echo $row["Caption"] . "<br>";
                echo $row["Caption Text"] . "<br>";
            if($row["File Type"] == "pdf") {
            	echo '<a href= "images/'.$filename.'.pdf">pdf link</a>';
            }
            else {
				echo '<a href ="images/'.$filename.'.'.$row["File Type"].'">';
            	echo '<img class="piechart" src= "images/'.$filename.'.'.$row["File Type"].'">';
            	echo '</a><br>';
            	echo '(click image to enlarge)';
            		}
		}?>
		</div>
		<?php $dbh = null; ?>
</body>
</html>