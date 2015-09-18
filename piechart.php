<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php 
		require 'credentials.php';
		include 'header.php';

		// From the pie chart id, get only the filename
		$id = filter_input(INPUT_GET, 'id');
		$string = explode('-', $id);
		$filename = $string[0];
		?>
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
                echo '<a href ="XML/'. $id .'.xml"> xml representation of chart </a>';
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