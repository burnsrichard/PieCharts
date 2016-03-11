<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PieCharts</title>

	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require 'credentials.php';
include 'header.php';
?>
<table>
    <tr>
        <th>Index</th>
        <th>Id</th>  
        <th>Date/time</th>
        <th>Message category</th>
        <th>Annotator</th>
    </tr>
	
<?php
try 
{
	// Create connection
	$dbh = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
} 
catch (PDOException $e) 
{
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
	$cnt = "SELECT COUNT(*) FROM `Annotations`"; 
	$stmt = $dbh->prepare($cnt);
	$stmt->execute();
	$total = $stmt->fetch();
	echo "Total number of pies shown: " . $total[0];
    
	$sql = "SELECT * FROM `Annotations` ORDER BY Pie_Id ASC";
	
	$result=$dbh->query($sql);
	$resultarray = $result->fetchAll();
	//print_r($resultarray);
	// foreach($dbh->query($sql) as $row)
	
	//create new array to store values of data structure and sort in the below array
	//using regex to sort special cases
	foreach($resultarray as $unsorted)
	{
		
		// ereg regex function
		if(ereg($unsorted["Pie_Id"], "^P[0-9]+$")>1)
		{
		 	//if tyler key[["Pie_Id"]][3] = [double]
			//if eric key[["Pie_Id"]][1] = [double]
			//if wik key[["Pie_Id"]][2] = [double]
			//if rich key[["Pie_Id"]][0] = [double]
			//key[["Pie_Id"]][] = [double]
		}	
		// ereg regex function
		if(ereg($unsorted["Pie_Id"], "^P[0-9]+-[A-Z]$")>1)
		{
			//sorted=[(pid).26]
		}	
		// ereg regex function
		if(ereg($unsorted["Pie_Id"], "")>1)
		{
			
		}	
		// ereg regex function
		if(ereg($unsorted["Pie_Id"], "")>1)
		{
			
		}	
	}
	 
    foreach($dbh->query($sql) as $row) 
	{ ?>
        <tr>
            <td><?php echo $row["Index"]?></td>
            <td><a href="piechart.php?id=<?php echo $row["Pie_Id"]?>">
                <?php 
                echo $row["Pie_Id"]; 
                ?></a>
            </td> 
            <td><?php echo $row["Timestamp"];?></td>
			<td><?php echo $row["Message"];?></td>
            <td><?php echo $row["Annotator"]?></td>
        </tr>
    <?php
    }
    ?>
</table>